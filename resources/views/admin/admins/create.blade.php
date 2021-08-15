<x-admin.layouts.app>

    <x-admin.page-heading title="{{ __('admin/crud.admins.create.page_title') }}" caption="{{ __('admin/crud.admins.create.page_caption') }}"></x-admin.page-heading>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">{{ __('admin/crud.admins.create.form_title') }}</h2>

                <livewire:admin.admins.create />

            </div>
        </div>
    </div>

</x-admin.layouts.app>
