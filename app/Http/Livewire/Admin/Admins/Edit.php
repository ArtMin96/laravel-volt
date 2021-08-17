<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Http\Livewire\Admin\Component;
use App\Http\Livewire\Traits\UserInformation;
use App\Models\Admin;
use App\Models\Admin\Role;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads,
        UserInformation;

    public Admin $admin;

    /** @var string $first_name */
    public string $first_name;

    /** @var string $last_name */
    public string $last_name;

    /** @var string $email */
    public string $email;

    public string $roleName;

    public function mount()
    {
        $this->first_name = $this->admin->first_name;
        $this->last_name = $this->admin->last_name;
        $this->email = $this->admin->email;
        $this->roleName = $this->admin->roles->pluck('name')[0];
    }

    protected function rules(): array
    {
        return array_merge([
            'email' => ['required', 'max:255', 'email', Rule::unique('admins')->ignore($this->admin->id)],
            'roleName' => ['required', 'exists:roles,name'],
        ], $this->rules);
    }

    /**
     * @throws ValidationException
     */
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateProfileInformation()
    {
        $this->resetErrorBag();

        $this->validate();

        $admin = $this->admin->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
        ]);

        if ($admin) {
            $this->admin->syncRoles($this->roleName);

            session()->flash('success', __('admin/crud.admins.edit.messages.success'));
            return redirect()->route('admin.admins');
        } else {
            session()->flash('danger', __('admin/crud.admins.edit.messages.danger'));
        }
    }

    public function render()
    {
        $roles = Role::all();
        return view('livewire.admin.admins.edit', [
            'roles' => $roles
        ]);
    }
}
