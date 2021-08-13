<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.roles.page_title') }}" caption="{{ __('admin/crud.roles.page_caption') }}">

        @can('add_roles')
            <x-slot name="toolbar">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    @svg('heroicon-o-plus', 'icon icon-xs me-2')
                    {{ __('admin/crud.roles.create_button') }}
                </a>
            </x-slot>
        @endcan

    </x-admin.page-heading>

    <x-admin.alert />

</x-admin.layouts.app>
