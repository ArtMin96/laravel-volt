<x-admin.dropdown dropdownButtonClasses="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                  buttonVariant="true"
                  contentClasses="dashboard-dropdown dropdown-menu-start mt-2 py-1">

    <x-slot name="triggerContent">
        @svg('heroicon-o-dots-horizontal', 'icon icon-xs')
    </x-slot>

    <x-slot name="content">
        <x-admin.dropdown-item route="{{ localizeURL(route('admin.admins.edit', $row->id)) }}" class="d-flex align-items-center">
            @svg('heroicon-s-user', 'dropdown-icon me-2')
            Edit user
        </x-admin.dropdown-item>

        <x-admin.dropdown-item route="{{ localizeURL(route('admin.profile')) }}" class="d-flex align-items-center text-danger rounded-bottom">
            @svg('heroicon-s-user-remove', 'dropdown-icon me-2')
            Delete user
        </x-admin.dropdown-item>
    </x-slot>
</x-admin.dropdown>
