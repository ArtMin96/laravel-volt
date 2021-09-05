<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\KeepSearches;

class SiteWideSearchItem extends Component
{
    use KeepSearches;

    public $item;

    public $keyword;

    public $model;

    public function getModelProperty()
    {
        return app("App\\Models\\".$this->item->model)::find($this->item->id);
    }

    public function render()
    {
        return view('livewire.admin.site-wide-search-item');
    }
}
