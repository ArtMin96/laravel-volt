<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SiteWideSearch extends Component
{

    public function mount()
    {
//        dd(getModels());
        $result = \App\Classes\SideWideSearch\SiteWideSearch::search('rafael');
//        dd($result);
    }

    public function render()
    {
        return view('livewire.site-wide-search');
    }
}
