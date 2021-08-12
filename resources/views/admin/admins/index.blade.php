<x-admin.layouts.app>

    <x-admin.page-heading title="Users List" caption="Your web analytics dashboard template.">

        @can('add_admins')
            <x-slot name="toolbar">
                <a href="{{ route('admin.admins.create') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    New User
                </a>
            </x-slot>
        @endcan

    </x-admin.page-heading>

    <livewire:admin.user-management.admins-table />
</x-admin.layouts.app>
