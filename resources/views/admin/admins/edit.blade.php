<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.admins.edit.page_title') }}" caption="{{ __('admin/crud.admins.edit.page_caption') }}">
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
        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">{{ __('admin/crud.admins.edit.form_title') }}</h2>

                <livewire:admin.admins.edit :admin="$admin" />

            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">{{ __('admin/crud.admins.update-password.form_title') }}</h2>

                <livewire:admin.admins.update-password :admin="$admin" />

            </div>
        </div>
    </div>

</x-admin.layouts.app>
