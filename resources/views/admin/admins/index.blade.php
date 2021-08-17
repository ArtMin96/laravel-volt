<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.admins.page_title') }}" caption="{{ __('admin/crud.admins.page_caption') }}">

        @can('add_admins')
            <x-slot name="toolbar">
                <x-admin.dropdown dropdownButtonClasses="btn btn-gray-800 d-inline-flex align-items-center"
                                  contentClasses="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">

                    <x-slot name="triggerContent">
                        @svg('heroicon-o-plus', 'icon icon-xs me-2')
                        {{ __('admin/crud.admins.create_button') }}
                    </x-slot>

                    <x-slot name="content">
                        <x-admin.dropdown-item route="{{ localizeURL(route('admin.admins.create')) }}" class="d-flex align-items-center">
                            @svg('heroicon-s-user-add', 'dropdown-icon text-gray-400 me-2')
                            {{ __('admin/crud.admins.create_button') }}
                        </x-admin.dropdown-item>

                        <x-admin.dropdown-item route="{{ localizeURL(route('admin.admins.create')) }}" class="d-flex align-items-center">
                            @svg('heroicon-s-mail', 'dropdown-icon text-gray-400 me-2')
                            Invite With Email
                        </x-admin.dropdown-item>
                        </form>
                    </x-slot>
                </x-admin.dropdown>
            </x-slot>
        @endcan

    </x-admin.page-heading>

    <x-admin.alert />

    <livewire:admin.user-management.admins-table />

</x-admin.layouts.app>
