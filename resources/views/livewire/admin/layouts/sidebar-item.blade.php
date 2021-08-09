<x-admin.sidebar-item class="{{ isset($item['route']) && in_array($item['route'], Request::segments()) ? 'active' : '' }}"
                      route="{{ route('admin.'.$item['route']) }}">
    <x-slot name="icon">
        @if($item['icon']['type'] == 'svg')
            <x-dynamic-component :component="'admin.icons.sidebar.'.$item['icon']['icon']" class="me-2" />
        @else
            <span class="{{ $item['icon']['icon'] }}"></span>
        @endif
    </x-slot>

    {{ $item['name'] }}

</x-admin.sidebar-item>
