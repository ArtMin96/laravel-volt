<a href="{{ $item->view_link }}"
   class="list-group-item list-group-item-action border-bottom"
   wire:click="keepSearch('{{ encrypt($keyword) }}', '{{ encrypt($item->model) }}')"
>
    <div class="row align-items-center">
        @if(in_array($item->model, ['Admin']))
            <div class="col-auto">
                <!-- Avatar -->
                <img alt="Image placeholder" src="{{ $item->profile_photo_url }}" class="avatar-md rounded">
            </div>
        @endif
        <div class="col ps-0 ms-2">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="h6 mb-0 text-small">{{ $item->match }}</h4>
                </div>
            </div>
        </div>
    </div>
</a>
