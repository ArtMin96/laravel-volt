@if(!$model->isDefault())
    <x-admin.dropdown dropdownButtonClasses="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                      buttonVariant="true"
                      contentClasses="dashboard-dropdown dropdown-menu-start mt-2 py-1">

        <x-slot name="triggerContent">
            @svg('heroicon-o-dots-horizontal', 'icon icon-xs')
        </x-slot>

        <x-slot name="content">
            @can('edit_roles')
                <x-admin.dropdown-item route="{{ localizeURL(route('admin.roles.edit', $model)) }}" class="d-flex align-items-center">
                    @svg('heroicon-o-pencil', 'dropdown-icon me-2')
                    {{ __('admin/crud.roles.table.action.edit') }}
                </x-admin.dropdown-item>
            @endcan

            @can('edit_roles')
                <x-admin.dropdown-item route="{{ localizeURL(route('admin.profile')) }}" class="d-flex align-items-center text-danger rounded-bottom">
                    @svg('heroicon-o-trash', 'dropdown-icon me-2')
                    {{ __('admin/crud.roles.table.action.delete') }}
                </x-admin.dropdown-item>
            @endcan
        </x-slot>
    </x-admin.dropdown>
@endif
