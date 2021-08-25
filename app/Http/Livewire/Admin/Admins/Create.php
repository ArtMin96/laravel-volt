<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Http\Livewire\Admin\Component;
use App\Http\Livewire\Traits\UserInformation;
use App\Models\Admin;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads,
        UserInformation;

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

    /** @var string $role */
    public string $role = '';

    /**
     * @return array
     */
    protected function rules(): array
    {
        return array_merge([
            'email' => ['required', 'max:255', 'email'],
            'role' => ['required', 'exists:roles,name'],
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

    /**
     * @throws ValidationException
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function createUser()
    {
        $this->resetErrorBag();

        $this->validate();

        $admin = Admin::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if ($admin) {

            $admin->assignRole($this->role);

            $role = Role::where('name', $this->role)->first();

            session()->flash('success', __('admin/crud.admins.create.messages.success', ['role' => $role->display_name]));
            return redirect()->route('admin.admins');
        } else {
            session()->flash('danger', __('admin/crud.admins.create.messages.danger'));
        }
    }

    public function render()
    {
        $roles = Role::all();

        return view('livewire.admin.admins.create', [
            'roles' => $roles
        ]);
    }
}
