<?php

namespace App\Http\Livewire\Admin\Layouts;

use App\Http\Livewire\Admin\Component;

class SidebarItem extends Component
{

    public $item;

    public function render()
    {
        return view('livewire.admin.layouts.sidebar-item');
    }
}
