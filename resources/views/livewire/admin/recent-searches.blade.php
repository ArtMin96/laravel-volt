<span class="scrolling-wrapper-item h4">
    <a class="btn btn-gray-300 btn-sm rounded-pill @if(isOfValidClass($searchedModel, [\App\Models\Admin::class, \App\Models\User::class])) d-flex align-items-center @endif"
       href="{{ $url }}"
    >
        @if(isOfValidClass($searchedModel, [\App\Models\Admin::class, \App\Models\User::class]))
            <div class="avatar me-2">
                <img src="{{ $searchedModel->profile_photo_url }}" class="rounded-circle" alt="">
            </div>
            <small class="me-2">{{ $searchedModel->fullName }}</small>
        @endif

        @svg('heroicon-o-search', 'icon icon-xs ml-1', ['width' => '15'])
    </a>
</span>
