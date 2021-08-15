<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Http\Livewire\Admin\Admins\Traits\Admins;
use App\Models\Admin;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads,
        Admins;

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

    protected function rules(): array
    {
        return array_merge([
            'email' => ['required', 'max:255', 'email:rfc,dns'],
            'password' => [
                'confirmed',
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

    public function updateProfileInformation()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.admins.create');
    }
}
