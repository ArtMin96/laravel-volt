<?php

namespace App\Http\Controllers\Admin;

class InvitationController extends Controller
{
    public function invitation()
    {
        return view('admin.admins.invitation.index');
    }
}
