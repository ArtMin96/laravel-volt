<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Http\Livewire\Traits\UserInformation;
use App\Models\Admin;
use App\Models\Admin\Invites;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Register extends Component
{
    use UserInformation;

    /** @var string $token */
    public string $token;

    /** @var string $first_name */
    public string $first_name = '';

    /** @var string $last_name */
    public string $last_name = '';

    /** @var string $email */
    public string $email = '';

    /** @var string $password */
    public string $password = '';

    /** @var string $passwordConfirmation */
    public string $passwordConfirmation = '';

    public array $roles = [];

    public Invites $invites;

    /**
     * @return array
     */
    protected function rules(): array
    {
        return array_merge([
            'password' => [
                'same:passwordConfirmation',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ], $this->rules);
    }

    public function mount()
    {
        $this->token = request()->token;

        $invite = Invites::where('token', $this->token)->firstOrFail();

        $this->invites = $invite;

        $this->email = $invite->email;

        $this->roles = collect($invite->inviteRoles)
            ->map(function ($role) {
                return $role->roles->name;
            })
            ->all();
    }

    public function register()
    {
        $this->resetErrorBag();

        $this->validate();

        $user = Admin::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->assignRole($this->roles);

        event(new Registered($user));

        Auth::guard('admin')->login($user, false);

        $this->invites->delete();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function render()
    {
        return view('livewire.admin.auth.register')->extends('layouts.admin.guest');
    }
}
