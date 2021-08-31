<?php

namespace App\Http\Livewire\Admin\Roles;

use App\Models\Admin\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class RolesTable extends DataTableComponent
{
    public bool $columnSelect = true;

    protected string $pageName = 'roles';

    protected string $tableName = 'role';

    public function columns(): array
    {
        return [
            Column::make(trans('admin/crud.roles.table.name'), 'name')
                ->sortable(),
            Column::make(trans('admin/crud.roles.table.display_name'), 'display_name')
                ->sortable(),
            Column::make(trans('admin/crud.roles.table.description'), 'description')
                ->sortable(),
            Column::make(trans('admin/crud.roles.table.permissions'), 'permissions'),
            Column::make(trans('admin/crud.roles.table.users_count'), 'users_count')
                ->sortable(),
            Column::make(trans('admin/crud.roles.table.default'), 'default')
                ->sortable(),
            Column::make(trans('admin/crud.table.actions'))
                ->excludeFromSelectable(),
        ];
    }

    public function query(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    public function rowView(): string
    {
        return 'admin.roles.includes.row';
    }
}
