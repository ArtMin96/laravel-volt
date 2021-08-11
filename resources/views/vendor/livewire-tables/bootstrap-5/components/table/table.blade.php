<div class="card card-body shadow border-0 table-wrapper table-responsive">
    <table {{ $attributes->except('wire:sortable') }} class="table user-table table-hover align-items-center">
        <thead>
            <tr>
                {{ $head }}
            </tr>
        </thead>

        <tbody {{ $attributes->only('wire:sortable') }}>
            {{ $body }}
        </tbody>
    </table>
</div>
