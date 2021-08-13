<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.roles.page_title') }}" caption="{{ __('admin/crud.roles.page_caption') }}">

        @can('add_roles')
            <x-slot name="toolbar">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    {{ __('admin/crud.roles.create_button') }}
                </a>
            </x-slot>
        @endcan

    </x-admin.page-heading>

</x-admin.layouts.app>
