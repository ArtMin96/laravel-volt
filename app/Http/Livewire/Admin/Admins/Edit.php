<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Http\Livewire\Admin\Admins\Traits\Admins;
use App\Models\Admin;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads,
        Admins;

    public Admin $admin;

    protected function rules(): array
    {
        return array_merge([
            'email' => ['required', 'max:255', 'email:rfc,dns', Rule::unique('admins')->ignore($this->admin->id)],
        ], $this->rules);
    }

    public function render()
    {
        return view('livewire.admin.admins.edit');
    }
}
