<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class PageHeading extends Component
{
    public string $title;

    public string $caption = '';

    public $toolbar = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $caption = '', $toolbar = '')
    {
        $this->title = $title;
        $this->caption = $caption;
        $this->toolbar = $toolbar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.page-heading');
    }
}
