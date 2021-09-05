<?php

namespace App\Classes\RecentSearches;

use Closure;
use DateTimeInterface;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use App\Classes\RecentSearches\Contracts\Searches as SearchesContract;

class RecentSearches
{
    use Macroable;

    protected UserResolver $userResolver;

    protected RecentSearchesStatus $searchesStatus;

    protected ?SearchesContract $searches = null;

    public function __construct(Repository $config, RecentSearchesStatus $searchesStatus, UserResolver $userResolver)
    {
        $this->userResolver = $userResolver;

        $this->searchesStatus = $searchesStatus;
    }

    public function setSearchesStatus(RecentSearchesStatus $searchesStatus): static
    {
        $this->searchesStatus = $searchesStatus;

        return $this;
    }

    public function performedOn(Model $model): static
    {
        $this->getSearches()->subject()->associate($model);

        return $this;
    }

    public function on(Model $model): static
    {
        return $this->performedOn($model);
    }

    public function byUser(Model | int | string | null $modelOrId): static
    {
        if ($modelOrId === null) {
            return $this;
        }

        $model = $this->userResolver->resolve($modelOrId);

        $this->getSearches()->user()->associate($model);

        return $this;
    }

    public function by(Model | int | string | null $modelOrId): static
    {
        return $this->byUser($modelOrId);
    }

    public function byAnonymousUser(): static
    {
        $this->searches->user_id = null;
        $this->searches->user_type = null;

        return $this;
    }

    public function byAnonymous(): static
    {
        return $this->byAnonymousUser();
    }

    public function withProperties(mixed $properties): static
    {
        $this->getSearches()->properties = collect($properties);

        return $this;
    }

    public function withProperty(string $key, mixed $value): static
    {
        $this->getSearches()->properties = $this->getSearches()->properties->put($key, $value);

        return $this;
    }

    public function createdAt(DateTimeInterface $dateTime): static
    {
        $this->getSearches()->created_at = Carbon::instance($dateTime);

        return $this;
    }

    public function tap(callable $callback, string $eventName = null): static
    {
        call_user_func($callback, $this->getSearches(), $eventName);

        return $this;
    }

    public function enableLogging(): static
    {
        $this->searchesStatus->enable();

        return $this;
    }

    public function disableLogging(): static
    {
        $this->searchesStatus->disable();

        return $this;
    }

    public function rememberSearch(string $description): ?SearchesContract
    {
        if ($this->searchesStatus->disabled()) {
            return null;
        }

        $searches = $this->searches;

        $searches->description = $this->replacePlaceholders(
            $searches->description ?? $description,
            $searches
        );

        $searches->save();

        $this->searches = null;

        return $searches;
    }

    public function withoutSearches(Closure $callback): mixed
    {
        if ($this->searchesStatus->disabled()) {
            return $callback();
        }

        $this->searchesStatus->disable();

        try {
            return $callback();
        } finally {
            $this->searchesStatus->enable();
        }
    }

    protected function replacePlaceholders(string $description, SearchesContract $searches): string
    {
        return preg_replace_callback('/:[a-z0-9._-]+/i', function ($match) use ($searches) {
            $match = $match[0];

            $attribute = Str::before(Str::after($match, ':'), '.');

            if (! in_array($attribute, ['subject', 'user', 'properties'])) {
                return $match;
            }

            $propertyName = substr($match, strpos($match, '.') + 1);

            $attributeValue = $searches->$attribute;

            if (is_null($attributeValue)) {
                return $match;
            }

            $attributeValue = $attributeValue->toArray();

            return Arr::get($attributeValue, $propertyName, $match);
        }, $description);
    }

    protected function getSearches(): SearchesContract
    {
        if (! $this->searches instanceof SearchesContract) {
            $this->searches = RecentSearchesServiceProvider::getActivityModelInstance();
            $this
                ->withProperties([])
                ->byUser($this->userResolver->resolve());
        }

        return $this->searches;
    }
}
