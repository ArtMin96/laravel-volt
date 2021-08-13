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

];
