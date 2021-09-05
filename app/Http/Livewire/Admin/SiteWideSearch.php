<?php

namespace App\Http\Livewire\Admin;

use App\Classes\SideWideSearch\SiteWideSearch as Search;

class SiteWideSearch extends Component
{

    /** @var string|null $keyword */
    public ?string $keyword = '';

    /** @var bool $showRecentSearches */
    public bool $showRecentSearches = false;

    /** @var array $result */
    public $result = [];

    /** @var array $recentSearches */
    public $recentSearches = [];

    public function mount()
    {
        $this->reset();
    }

    public function updatedKeyword()
    {
        $this->result = Search::search($this->keyword);
    }

    public function updatedShowRecentSearches()
    {
        $this->recentSearches = $this->showRecentSearches ? admin()->recentSearchesByUser()->latest()->take(4)->get() : collect();
    }

    public function render()
    {
        return view('livewire.admin.site-wide-search');
    }
}
