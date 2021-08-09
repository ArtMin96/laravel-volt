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
                'name' => trans('admin/sidebar.roles_permissions'),
                'icon' => [
                    'type' => 'icon',
                    'icon' => 'fas fa-key'
                ],
                'child' => [
                    [
                        'route' => 'dashboard',
                        'name' => trans('admin/sidebar.roles'),
                        'icon' => 'dashboard',
                    ],
                    [
                        'route' => 'dashboard',
                        'name' => trans('admin/sidebar.permissions'),
                        'icon' => 'dashboard',
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
