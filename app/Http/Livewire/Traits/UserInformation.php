<?php

namespace App\Http\Livewire\Traits;

trait UserInformation
{
    protected array $rules = [
        'first_name' => ['required', 'max:255'],
        'last_name' => ['required', 'max:255'],
    ];
}
