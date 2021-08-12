@if ($showSearch)
    <div class="mb-3 mb-md-0 input-group me-2 me-lg-3 fmxw-300">
        <span class="input-group-text">
            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
            </svg>
        </span>

        <input
            wire:model{{ $this->searchFilterOptions }}="filters.search"
            placeholder="{{ __('Search') }}"
            type="text"
            class="form-control"
        >

        @if (isset($filters['search']) && strlen($filters['search']))
            <button wire:click="$set('filters.search', null)" class="btn btn-outline-secondary" type="button">
                <svg style="width:.75em;height:.75em" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
    </div>
@endif
