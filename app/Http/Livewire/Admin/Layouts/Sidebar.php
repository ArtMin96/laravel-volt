<?php

namespace App\Http\Livewire\Admin\Layouts;

use Livewire\Component;

class Sidebar extends Component
{
    /**
     * Admin sidebar items.
     *
     * @return array
     */
    public function items(): array
    {
        return [
            [
                'route' => 'dashboard',
                'role' => '',
                'name' => trans('admin/sidebar.dashboard'),
                'icon' => [
                    'type' => 'svg',
                    'icon' => 'dashboard'
                ]
            ],
            [
                'role' => 'view_admins|view_users',
                'name' => trans('admin/sidebar.user_management'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-users'
                ],
                'child' => [
                    [
                        'route' => 'user',
                        'role' => 'view_users',
                        'name' => trans('admin/sidebar.users'),
                    ],
                    [
                        'route' => 'admins',
                        'role' => 'view_admins',
                        'name' => trans('admin/sidebar.admins'),
                    ]
                ]
            ],
            [
                'route' => 'roles',
                'role' => 'view_roles',
                'name' => trans('admin/sidebar.roles'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-key'
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admin.layouts.sidebar', [
            'items' => $this->items()
        ]);
    }
}
