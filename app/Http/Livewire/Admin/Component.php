<?php

namespace App\Http\Livewire\Admin;

use App\Traits\Admin\GuardsAgainstAccess;
use Livewire\Component as BaseComponent;

class Component extends BaseComponent
{
    use GuardsAgainstAccess;

    protected string $guard = 'admin';
}
