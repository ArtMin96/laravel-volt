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
        'back' => 'Back',

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
        'page_caption' => 'Your web analytics dashboard template.',
        'create_button' => 'New User',
        'edit_role' => 'Edit user',
        'delete_role' => 'Delete user',
        'back' => 'Back',

        'table' => [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'E-mail',
        ],

        'create' => [
            'page_title' => 'Add administrator user',
            'page_caption' => 'Your administrator user creation template.',
            'form_title' => 'General information',

            'messages' => [
                'success' => 'New user added with role :Role.',
                'danger' => 'Cannot add a new user.',
            ],
        ],

        'edit' => [
            'page_title' => 'Edit administrator user',
            'page_caption' => 'Your administrator user editing template.',
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
        ]
    ],

    'table' => [
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'actions' => 'Actions',
    ]

];
