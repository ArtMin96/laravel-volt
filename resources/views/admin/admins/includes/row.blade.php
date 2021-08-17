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

<x-livewire-tables::table.cell>
    <div>
        {{ carbon($row->created_at)->diffForHumans() }}
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div>
        {{ carbon($row->updated_at)->diffForHumans() }}
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @includeIf('admin.admins.includes.actions', ['model' => $row])
</x-livewire-tables::table.cell>
