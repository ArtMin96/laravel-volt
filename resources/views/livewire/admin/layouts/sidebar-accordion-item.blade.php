<x-admin.sidebar-accordion-item class="{{ isset($item['route']) && in_array($item['route'], Request::segments()) ? 'active' : '' }}">

    <x-slot name="icon">
        @if($item['icon']['type'] == 'svg')
            <x-dynamic-component :component="'admin.icons.sidebar.'.$item['icon']['icon']" class="me-2" />
        @else
            <span class="{{ $item['icon']['icon'] }}"></span>
        @endif
    </x-slot>

    {{ html_entity_decode($item['name']) }}

    <x-slot name="child">
        @forelse($item['child'] as $child)
            <x-admin.sidebar-item class="{{ in_array($child['route'], Request::segments()) ? 'active' : '' }}"
                                  route="{{ route('admin.'.$child['route']) }}">

                {{ html_entity_decode($child['name']) }}

            </x-admin.sidebar-item>
        @empty
        @endforelse
    </x-slot>

</x-admin.sidebar-accordion-item>
