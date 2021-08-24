<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.admins.invite-user.page_title') }}" caption="{{ __('admin/crud.admins.invite-user.page_caption') }}">

        @can('view_admins')
            <x-slot name="toolbar">
                <a href="{{ route('admin.admins') }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
                    @svg('heroicon-o-arrow-circle-left', 'icon icon-xs me-2')
                    {{ __('admin/crud.back') }}
                </a>
            </x-slot>
        @endcan

    </x-admin.page-heading>

    <div class="row">
        <livewire:admin.admins.invitation.manager />

        <livewire:admin.admins.invitation.invites />
    </div>

</x-admin.layouts.app>
