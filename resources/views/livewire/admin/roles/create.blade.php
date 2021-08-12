<form wire:submit.prevent="save" method="POST">
    <div class="row">
        <div class="col-md-4 mb-3">
            <div>
                <label for="name">Role name</label>
                <input wire:model.defer="name" class="form-control " id="name" type="text" placeholder="Enter role name" required="">
            </div>
        </div>
    </div>
    <div class="row">
        @if(!empty(getSupportedLocales()))
            @foreach(getSupportedLocales() as $localeCode => $properties)
                <div class="col-md-4 mb-3">
                    <div>
                        <label for="display_name">Role description {{ \Illuminate\Support\Str::ucfirst($properties['native']) }}</label>
                        <input wire:model.defer="display_name.{{ $localeCode }}" class="form-control " id="display_name" type="text" placeholder="Enter role description for {{ \Illuminate\Support\Str::ucfirst($properties['native']) }}" required="">
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">Save All</button>
    </div>
</form>
