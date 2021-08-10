@props([
    'dropdownButtonClasses' => '',
    'showToggleIcon' => false,
    'buttonVariant' => false,
    'contentClasses' => '',
    'dropdownClasses' => ''
])

@php
    $randomString = \Illuminate\Support\Str::random(20);
    $variant = $buttonVariant ? 'button' : 'a';
@endphp

<div class="{{ $buttonVariant ? 'btn-group' : 'dropdown' }} {{ $dropdownClasses }}">
    <{{ $variant }} class="{{ $dropdownButtonClasses }} {{ !$showToggleIcon ? '' : 'dropdown-toggle' }}" {{ $buttonVariant ? '' : 'href=#' }} role="button" id="dropdown{{ $randomString }}" data-bs-toggle="dropdown" aria-expanded="false">
        {{ $triggerContent }}
    </{{ $variant }}>

    <ul class="dropdown-menu {{ $contentClasses }}" aria-labelledby="dropdown{{ $randomString }}">
        {{ $content }}
    </ul>
</div>
