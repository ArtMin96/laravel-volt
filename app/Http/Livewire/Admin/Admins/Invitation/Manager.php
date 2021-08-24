<?php

namespace App\Http\Livewire\Admin\Admins\Invitation;

use App\Http\Livewire\Admin\Component;
use App\Models\Admin\InviteRole;
use App\Models\Admin\Invites;
use App\Models\Admin\Role;
use App\Notifications\Admin\InviteNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Manager extends Component
{

    /** @var string $email */
    public string $email = '';

    /** @var array $selectedRole */
    public array $selectedRole = [];

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:admins,email', 'unique:invites,email'],
            'selectedRole.*' => ['required', 'exists:roles,name'],
        ];
    }

    public function process()
    {
        $this->resetErrorBag();

        $this->validate();

        do {
            $token = Str::random(20);
        } while (Invites::where('token', $token)->first());

        DB::beginTransaction();

        try {
            $storeInvite = Invites::create([
                'token' => $token,
                'email' => $this->email
            ]);

            $attachRoles = [];

            foreach ($this->selectedRole as $role) {
                $attachRoles[] = new InviteRole([
                    'role' => $role
                ]);
            }

            $storeInvite->roles()->saveMany($attachRoles);

            $url = URL::temporarySignedRoute(
                'admin.register', now()->addMinutes(300), ['token' => $token]
            );

            Notification::route('mail', $this->email)->notify(new InviteNotification($url));

            DB::commit();

            $this->reset();

            $this->emit('refreshInvitationList');

            session()->flash('success', trans('admin/crud.admins.invite-user.messages.success'));
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('danger', trans('admin/crud.admins.invite-user.messages.danger'));
        }

    }

    /**
     * Get the available roles.
     *
     * @return array
     */
    public function getRolesProperty(): array
    {
        return collect(Role::all())
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.admin.admins.invitation.manager');
    }
}
