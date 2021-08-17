<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Http\Livewire\Admin\Component;
use App\Models\Admin;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdatePassword extends Component
{
    /** @var Admin $admin */
    public Admin $admin;

    /** @var string $current_password */
    public string $current_password = '';

    /** @var string $password */
    public string $password = '';

    /** @var string $passwordConfirmation */
    public string $passwordConfirmation = '';

    protected function rules(): array
    {
        return [
            'current_password' => ['required', new MatchOldPassword($this->admin)],
            'password' => [
                'same:passwordConfirmation',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ];
    }

    public function changePassword()
    {
        $this->resetErrorBag();

        $this->validate();

        $this->admin->password = Hash::make($this->password);

        if ($this->admin->save()) {
            $this->reset();

            session()->flash('success', __('admin/crud.admins.update-password.messages.success'));
        } else {
            session()->flash('danger', __('admin/crud.admins.update-password.messages.danger'));
        }
    }

    public function render()
    {
        return view('livewire.admin.admins.update-password');
    }
}
