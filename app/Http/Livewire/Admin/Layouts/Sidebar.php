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
                'route' => 'user',
                'name' => trans('admin/sidebar.user_management'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-users'
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
                        'route' => 'role',
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
