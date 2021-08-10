@props(['route' => ''])

@if($route)
    <a href="{{ $route }}" {{ $attributes->merge(['class' => 'dropdown-item']) }}>
@else
    <div {{ $attributes->merge(['class' => 'dropdown-item cursor-pointer']) }}>
@endif

    {{ $slot }}

@if(!$route) </div> @else </a> @endif
