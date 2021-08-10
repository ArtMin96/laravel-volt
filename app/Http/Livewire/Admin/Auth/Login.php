<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Traits\Admin\GuardsAgainstAccess;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    use GuardsAgainstAccess;

    protected string $guard = 'admin';

    /** @var string  */
    public string $email = '';

    /** @var string  */
    public string $password = '';

    protected array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        if (!Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', trans('auth.failed'));

            return;
        }

        return redirect()->intended(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.admin.auth.login')->extends('layouts.admin.guest');
    }
}
