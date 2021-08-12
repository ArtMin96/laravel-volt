<?php

namespace App\Http\Livewire\Admin\UserManagement;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class AdminsTable extends DataTableComponent
{
    public bool $columnSelect = true;

    public array $sortNames = [
        'email_verified_at' => 'Verified',
    ];

    public array $filterNames = [
        'verified' => 'E-mail Verified',
    ];

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];

    protected string $pageName = 'admins';
    protected string $tableName = 'admins';

    public function filters(): array
    {
        return [
            'verified' => Filter::make('E-mail Verified')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('First name', 'first_name')
                ->sortable(),
            Column::make('Last name', 'last_name')
                ->sortable(),
            Column::make('E-mail', 'email')
                ->sortable(),
        ];
    }

    public function query()
    {
        return Admin::query()
            ->when($this->getFilter('search'), fn($query, $search) => $query->search($search));
    }

    public function rowView(): string
    {
        return 'admin.admins.table';
    }
}