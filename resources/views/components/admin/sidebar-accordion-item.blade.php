@props(['randomString' => \Illuminate\Support\Str::random(20), 'active' => null])

<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    <span class="nav-link collapsed d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#submenu-{{ $randomString }}">
        <span>

            @isset($icon)
                <span class="sidebar-icon">
                    {{ $icon }}
                </span>
            @endisset

            <span class="sidebar-text">
                {{ $slot }}
            </span>

        </span>

        <span class="link-arrow">
            <x-admin.icons.sidebar.arrow />
        </span>
    </span>

    <div class="multi-level collapse {{ $active }}"
         role="list" id="submenu-{{ $randomString }}" aria-expanded="false">

        <ul class="flex-column nav">

            {{ $child }}

        </ul>
    </div>
</li>
