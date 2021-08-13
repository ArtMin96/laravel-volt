<x-livewire-tables::table.cell>
    <div>{{ $row->first_name }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div>{{ $row->last_name }}</div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div><a href="mailto:{{ $row->email }}" class="hover:underline">{{ $row->email }}</a></div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div>
        @if ($row->email_verified_at)
            Yes
        @else
            No
        @endif
    </div>
</x-livewire-tables::table.cell>

{{--<x-livewire-tables::table.cell>--}}
{{--    <a href="#" wire:click.prevent="manage({{ $row->id }})" class="text-primary-600 font-medium hover:text-primary-900">Manage</a>--}}
{{--</x-livewire-tables::table.cell>--}}
