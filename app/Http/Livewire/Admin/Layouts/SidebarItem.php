<?php

namespace App\Http\Livewire\Admin\Layouts;

use Livewire\Component;

class SidebarItem extends Component
{

    public $item;

    public function render()
    {
        return view('livewire.admin.layouts.sidebar-item');
    }
}
