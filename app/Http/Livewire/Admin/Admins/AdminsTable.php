<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class AdminsTable extends DataTableComponent
{
    public bool $columnSelect = true;

    public array $sortNames = [
        'email_verified_at' => 'Verified',
    ];

    protected string $pageName = 'admins';
    protected string $tableName = 'admins';

    public function filters(): array
    {
        return [
            'created_at' => Filter::make(trans('admin/crud.table.created_at'))
                ->date(),
            'updated_at' => Filter::make(trans('admin/crud.table.updated_at'))
                ->date(),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make(trans('admin/crud.admins.table.first_name'), 'first_name')
                ->sortable(),
            Column::make(trans('admin/crud.admins.table.last_name'), 'last_name')
                ->sortable(),
            Column::make(trans('admin/crud.admins.table.email'), 'email')
                ->sortable(),
            Column::make(trans('Roles')),
            Column::make(trans('Additional Permissions')),

            Column::make(trans('admin/crud.table.created_at'), 'created_at')
                ->sortable(),
            Column::make(trans('admin/crud.table.updated_at'), 'updated_at')
                ->sortable(),
            Column::make(trans('admin/crud.table.actions'))
                ->excludeFromSelectable(),
        ];
    }

    public function query(): Builder
    {
        return Admin::query()
            ->when($this->getFilter('search'), fn($query, $search) => $query->search($search))
            ->when($this->getFilter('created_at'), fn($query, $search) => $query->whereDate('created_at', $search))
            ->when($this->getFilter('updated_at'), fn($query, $search) => $query->whereDate('updated_at', $search));
//            ->when($this->getFilter('verified'), fn ($query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at'));
    }

    public function rowView(): string
    {
        return 'admin.admins.includes.row';
    }
}
