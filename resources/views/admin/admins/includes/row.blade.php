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
        @php $roleCount = 1; @endphp

        @foreach($row->roles_label as $key => $role)
            @if($roleCount % 3 == 1)
                <br>
            @endif

            <span class="badge rounded-pill bg-primary p-2 px-3 fw-bolder mb-2">{{ $role }}</span>

            @php $roleCount++; @endphp
        @endforeach
    </div>
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
