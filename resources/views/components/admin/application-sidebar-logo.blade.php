<li class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
        <span class="sidebar-icon me-3">
            <img src="{{ asset('assets/img/brand/light.svg') }}" height="20" width="20" alt="{{ str_replace('_', ' ', config('app.name')) }} Logo">
        </span>
        <span class="mt-1 ms-1 sidebar-text">
            {{ str_replace('_', ' ', config('app.name')) }}
        </span>
    </a>
</li>
