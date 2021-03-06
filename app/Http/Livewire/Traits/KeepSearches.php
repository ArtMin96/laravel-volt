<?php

namespace App\Http\Livewire\Traits;

trait KeepSearches
{
    public function keepSearch($keyword, ?string $modelName = null)
    {
        $keyword = decrypt($keyword);
        $modelName = decrypt($modelName);

        $storeSearch = recentSearches();

        if ($modelName !== null) {
            $model = app("App\\Models\\".$modelName)::find($this->item->id);
            $storeSearch->performedOn($model);
        }

        $storeSearch->byUser(admin())
            ->rememberSearch($keyword);
    }
}
