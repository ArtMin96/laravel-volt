<x-livewire-tables::table.cell>
    <p class="text-blue-400 truncate">
        {{ $row->first_name }}
    </p>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <p class="text-blue-400 truncate">
        {{ $row->last_name }}
    </p>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <p class="text-blue-400 truncate">
        <a href="mailto:{{ $row->email }}" class="hover:underline">{{ $row->email }}</a>
    </p>
</x-livewire-tables::table.cell>
