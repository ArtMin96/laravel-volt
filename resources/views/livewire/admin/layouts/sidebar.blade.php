<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-2 pt-3">

        <div class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ admin()->profile_photo_url }}" class="card-img-top rounded-circle border-white" alt="{{ admin()->fullName }}">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, {{ admin()->first_name }}</h2>
                    <a href="{{ route('admin.login') }}" class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <x-admin.icons.sidebar.logout class="me-1" />
                        {{ __('admin/base.sign_out') }}
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <x-admin.icons.sidebar.close />
                </a>
            </div>
        </div>

        <ul class="nav flex-column pt-3 pt-md-0">

            <x-admin.application-sidebar-logo />

            @forelse($items as $key => $item)
                @if(admin()->hasAnyPermission(givenPermissions($item['role'])))
                    @if(!isset($item['child']))
                        <livewire:admin.layouts.sidebar-item :key="$key" :item="$item" />
                    @else
                        <livewire:admin.layouts.sidebar-accordion-item :key="$key" :item="$item" />
                    @endif
                @endif
            @empty
            @endforelse
        </ul>
    </div>
</nav>
