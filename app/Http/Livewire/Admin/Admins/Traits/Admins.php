<?php

namespace App\Http\Livewire\Admin\Admins\Traits;

trait Admins
{
    protected array $rules = [
        'first_name' => ['required', 'max:255'],
        'last_name' => ['required', 'max:255'],
    ];
}
