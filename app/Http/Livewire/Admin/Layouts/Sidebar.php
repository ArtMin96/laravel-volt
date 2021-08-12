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
                'name' => trans('admin/sidebar.dashboard'),
                'icon' => [
                    'type' => 'svg',
                    'icon' => 'dashboard'
                ]
            ],
            [
                'name' => trans('admin/sidebar.user_management'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-users'
                ],
                'child' => [
                    [
                        'route' => 'user',
                        'name' => trans('admin/sidebar.users'),
                    ],
                    [
                        'route' => 'admins',
                        'name' => trans('admin/sidebar.admins'),
                    ]
                ]
            ],
            [
                'name' => trans('admin/sidebar.roles_permissions'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-key'
                ],
                'child' => [
                    [
                        'route' => 'roles',
                        'name' => trans('admin/sidebar.roles'),
                    ],
                    [
                        'route' => 'permission',
                        'name' => trans('admin/sidebar.permissions'),
                    ]
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
