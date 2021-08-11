<?php

namespace App\View\Components\Admin\Layouts;

use Illuminate\View\Component;

class App extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.admin.app');
    }
}
