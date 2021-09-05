<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Classes\SideWideSearch\SiteWideSearch as SiteSearch;

class RecentSearches extends Component
{
    public $searchedItem;

    public $searchedModel;

    public string $url;

    public function mount()
    {
        $this->searchedModel = $this->searchedItem->subject()->first();

        $this->url = SiteSearch::resolveModelViewLink($this->searchedModel);
    }

    public function render()
    {
        return view('livewire.admin.recent-searches');
    }
}
