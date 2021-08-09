@props(['route' => null])

<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    <a href="{{ $route }}" class="nav-link">

        @isset($icon)
            <span class="sidebar-icon">
                {{ $icon }}
            </span>
        @endisset

        <span class="sidebar-text">
            {{ $slot }}
        </span>
    </a>
</li>
