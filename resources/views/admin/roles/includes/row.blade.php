<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->display_name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->description }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <div>
        @php $permissionCount = 1; @endphp

        @foreach($row->permissions_label as $key => $permission)
            @if($permissionCount % 3 == 1)
                <br>
            @endif

            <span class="badge rounded-pill bg-primary p-2 px-3 fw-bolder mb-2">{{ $permission }}</span>

            @php $permissionCount++; @endphp
        @endforeach
    </div>
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->users_count }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->default }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @includeIf('admin.roles.includes.actions', ['model' => $row])
</x-livewire-tables::table.cell>