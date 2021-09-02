<?php

namespace App\Classes\SideWideSearch;

use App\Classes\SideWideSearch\Controllers\SiteWideSearchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class SiteWideSearch
{
    /**
     * @param SplFileInfo $fileInfo
     * @return string|null
     */
    public static function parseModelNameFromFile(SplFileInfo $fileInfo): ?string
    {
        $filename = $fileInfo->getRelativePathname();

        # Assume model name is equal to file name
        if (!str_ends_with($filename, '.php')) {
            return null;
        }

        # Remove .php
        return substr($filename, 0, -4);
    }

    /**
     * @param string|null $classname
     * @return bool
     * @throws \ReflectionException
     */
    public static function filterSearchableModel(?string $classname): bool
    {
        if (!class_exists($classname)) {
            return false;
        }

        # Using reflection class to obtain class info dynamically
        $reflection = new \ReflectionClass(self::modelNamespacePrefix() . $classname);

        # Making sure the class extended eloquent model
        $isModel = $reflection->isSubclassOf(Model::class);

        # Making sure the model implemented the searchable trait
        $searchable = $reflection->hasMethod('search');

        # Filter model that has the searchable trait and not in exclude array
        return class_exists($classname) && $isModel && $searchable && !in_array($reflection->getName(), config('site-wide-search.exclude'), true);
    }

    /**
     * Creating a callback function to set search attributes to the model.
     *
     * @param Model $model
     * @param array $fields
     * @param $keyword
     * @return string
     */
    public static function createMatchAttribute(Model $model, array $fields, $keyword): string
    {
        # Only extracting the relevant fields from the model
        $fieldsData = $model->only($fields);

        # Joining the fields together
        $serializedValues = collect($fieldsData)->join(' ');

        # Finding the position of match
        $searchPos = strpos(strtolower($serializedValues), strtolower($keyword));

        # Our goal here:
        # After finding the match position, we also want to include the surrounding text, so our user would have a better search experience.
        # We append or prepend `...` if there are more text before / after our match + neighbouring text including the found terms.
        if ($searchPos !== false) {
            $buffer = config('site-wide-search.buffer');

            # The buffer number dictates how many neighbouring characters to display
            $start = $searchPos - $buffer;

            # We don't want to go below 0 as the starting position
            $start = $start < 0 ? 0 : $start;

            # Multiply 2 buffer to cover the text before and after the match
            $length = strlen($keyword) + 2 * $buffer;

            # Getting the match and neighbouring text
            $sliced = substr($serializedValues, $start, $length);

            # Adding prefix and postfix dots

            # If start position is negative, there is no need to prepend `...`
            $shouldAddPrefix = $start > 0;

            # If end position went over the total length, there is no need to append `...`
            $shouldAddPostfix = ($start + $length) < strlen($serializedValues);

            $sliced = $shouldAddPrefix ? '...' . $sliced : $sliced;
            $sliced = $shouldAddPostfix ? $sliced . '...' : $sliced;
        }

        return $sliced ?? substr($serializedValues, 0, 20) . '...';
    }

    public static function search(string $keyword)
    {
        # Getting all the model files from model folder
        if (self::isTesting()) {
            $files = File::allFiles(__DIR__ . '/../tests/Models');
        } else {
            $files = File::allFiles(app()->basePath() . '/app/' . config('site-wide-search.model_path'));
        }

        # To get all the model classes
        return collect($files)
            ->map([self::class, 'parseModelNameFromFile'])
            ->filter([self::class, 'filterSearchableModel'])
            ->map(function ($classname) use ($keyword) {
                # For each class, call the search function
                $model = app(self::modelNamespacePrefix() . $classname);

                /**
                 * Our goal here: to add these 3 attributes to each of our search result:
                 * a. `match` -- the match found in our model records
                 * b. `model` -- the related model name
                 * c. `view_link` -- the URL for the user to navigate in the frontend to view the resource
                 */

                # To create the `match` attribute, we need to join the value of all the searchable fields in
                # our model, ie all the fields defined in our 'toSearchableArray' model method

                # We make use of the SEARCHABLE_FIELDS constant in our model
                # we don't want id in the match, so we filter it out.
                $fields = array_filter($model::SEARCHABLE_FIELDS, fn($field) => $field !== 'id');

                return $model::search($keyword)
                    ->take(config('site-wide-search.search_limit_per_model'))
                    ->get()
                    ->map(function (Model $modelRecord) use ($keyword, $fields, $classname) {
                        # Use $slice as the match, otherwise if undefined we use the first 20 character of serializedValues
                        $modelRecord->setAttribute('match', self::createMatchAttribute($modelRecord, $fields, $keyword));

                        # Setting the model name
                        $modelRecord->setAttribute('model', $classname);

                        # Setting the resource link
                        $modelRecord->setAttribute('view_link', self::resolveModelViewLink($modelRecord));

                        return $modelRecord;
                    });
            })->flatten(1);
    }

    /**
     * Helper function to retrieve resource URL.
     *
     * @param Model $model
     * @return string
     */
    public static function resolveModelViewLink(Model $model): string
    {
        # Here we list down all the alternative model-link mappings
        # if we don't have a record here, will default to /{model-name}/{model_id}
        $mapping = config('site-wide-search.view_mapping');

        # Getting the Fully Qualified Class Name of model
        $modelClass = get_class($model);

        # Converting model name to kebab case
        $modelName = Str::plural(Arr::last(explode('\\', $modelClass)));
        $modelName = Str::kebab(Str::camel($modelName));

        # Attempt to get from $mapping. We assume every entry has an `{id}` for us to replace
        if (Arr::has($mapping, $modelClass)) {
            $replace = [
                '{id}' => $model->id,
                '{ id }' => $model->id,
            ];

            return URL::to(str_replace(
                array_keys($replace),
                array_values($replace),
                $mapping[$modelClass]
            ));
        }

        # Assume /{model-name}/{model_id}
        return URL::to('/' . strtolower($modelName) . '/' . $model->id);
    }

    /**
     * Register the api routes
     */
    public static function routes()
    {
        Route::get(config('site-wide-search.api.url'), [SiteWideSearchController::class, 'search']);
    }

    /**
     * @return bool|string
     */
    private static function isTesting(): bool|string
    {
        return App::environment('testing');
    }

    /**
     * A helper function to generate the model namespace.
     *
     * @return string
     */
    private static function modelNamespacePrefix(): string
    {
        if (self::isTesting()) {
            return (new \ReflectionClass(self::class))->getNamespaceName() . '\\Tests\\Models\\';
        }

        return app()->getNamespace() . config('site-wide-search.model_path') . '\\';
    }
}
