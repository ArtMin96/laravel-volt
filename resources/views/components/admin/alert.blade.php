@foreach (['default', 'success', 'warning', 'danger', 'info'] as $type)
    <x-alert :type="$type" class="alert alert-{{ $type }}">
        {{ $component->message() }}
    </x-alert>
@endforeach
