<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Create/Update Language Lines
    |--------------------------------------------------------------------------
    |
    */

    'roles' => [
        'page_title' => 'Role Management',
        'page_caption' => 'Your role management dashboard template.',
        'create_button' => 'New role',
        'edit_role' => 'Edit role',
        'delete_role' => 'Delete role',

        'create' => [
            'page_title' => 'Add role',
            'page_caption' => 'Your role creation template.',
            'form_title' => 'Role information',

            'messages' => [
                'success' => 'Role added in your system',
                'danger' => 'Cannot add a new role.',
                'exists' => 'A role :Name already exists for the admin',
            ],
        ],

        'edit' => [
            'page_title' => 'Edit role',
            'page_caption' => 'Your role editing template.',
            'form_title' => 'Role information',

            'messages' => [
                'success' => 'Role updated successfully',
                'danger' => 'Cannot update role.'
            ],
        ],
    ],

    'admins' => [
        'page_title' => 'Admins List',
        'page_caption' => 'Your administrator users management template.',
        'create_button' => 'New User',
        'edit_role' => 'Edit user',
        'delete_role' => 'Delete user',
        'invite_with_email' => 'Invite with Email',

        'table' => [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'E-mail',
        ],

        'create' => [
            'page_title' => 'Add administrator user',
            'page_caption' => 'Your administrator users creation template.',
            'form_title' => 'General information',

            'messages' => [
                'success' => 'New user added with role :Role.',
                'danger' => 'Cannot add a new user.',
            ],
        ],

        'edit' => [
            'page_title' => 'Edit administrator user',
            'page_caption' => 'Your administrator users editing template.',
            'form_title' => 'General information',

            'messages' => [
                'success' => 'User updated successfully',
                'danger' => 'Cannot update user.'
            ],
        ],

        'update-password' => [
            'form_title' => 'Update password',

            'messages' => [
                'success' => 'Password updated successfully.',
                'danger' => 'Cannot update the password.',
            ],
        ],

        'invite-user' => [
            'page_title' => 'Invite administrator user',
            'page_caption' => 'Your administrator users invitation template.',
            'form_title' => 'Please provide the email address of the person you would like to add.',
            'role_section_title' => 'Role',
            'invites_title' => 'All of the people that are invited.',

            'messages' => [
                'success' => 'The Invite has been sent successfully',
                'danger' => 'Cannot send invitation',
            ],
        ],
    ],

    'table' => [
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'actions' => 'Actions',
    ],

    'back' => 'Back',

];
