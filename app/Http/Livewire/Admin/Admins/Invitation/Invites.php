<?php

namespace App\Http\Livewire\Admin\Admins\Invitation;

use App\Http\Livewire\Admin\Component;
use Livewire\WithPagination;

class Invites extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'bootstrap';

    protected int $perPage = 4;

    protected $listeners = [
        'refreshInvitationList' => '$refresh'
    ];

    /**
     * @param $id
     */
    public function cancelInvitation($id)
    {
        \App\Models\Admin\Invites::destroy(decrypt($id));
    }

    public function render()
    {
        return view('livewire.admin.admins.invitation.invites', [
            'invites' => \App\Models\Admin\Invites::orderBy('created_at', 'desc')->paginate($this->perPage)
        ]);
    }
}
