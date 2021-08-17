<?php

namespace App\Http\Livewire\Admin;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard')->extends('layouts.admin.app');
    }
}
