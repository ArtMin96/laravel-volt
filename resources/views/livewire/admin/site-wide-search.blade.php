<div class="navbar-search form-inline position-relative" id="navbar-search-main">
    <div class="input-group input-group-merge search-bar">
        <span class="input-group-text" id="topbar-addon">
            <svg class="icon icon-xs" x-description="Heroicon name: solid/search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                      clip-rule="evenodd">
                </path>
              </svg>
            </span>
        </span>
        <input type="text"
               class="form-control"
               id="topbarInputIconLeft"
               placeholder="Search"
               aria-label="Search"
               aria-describedby="topbar-addon"
               autocomplete="off"
               wire:model="keyword"
               wire:keydown.escape="reset"
               wire:keydown.tab="reset"
               wire:click="$toggle('showRecentSearches')"
        >
    </div>

    @if($showRecentSearches)
        <div class="position-absolute w-100 z-2 mt-2">

            <div class="card notification-card border-0 shadow">
                <div class="mt-3 pb-2 @if(!empty($keyword)) border-bottom @endif">
                    <small class="dropdown-header mb-n2 text-muted fw-500">Recent searches</small>

                    <div class="dropdown-item bg-transparent text-wrap my-2">
                        <span class="h4 mr-2">
                            <a class="btn btn-gray-300 btn-sm rounded-pill" href="./index.html">
                                <small>Gulp</small> @svg('heroicon-o-search', 'icon icon-xs ml-1', ['width' => '15'])
                            </a>
                        </span>
                        <span class="h4">
                            <a class="btn btn-gray-300 btn-sm rounded-pill" href="./index.html">
                                <small>Notification panel</small> @svg('heroicon-o-search', 'icon icon-xs ml-1', ['width' => '15'])
                            </a>
                        </span>
                    </div>
                </div>

                @if(!empty($keyword))
                    <div class="list-group list-group-flush">
                        @if(!empty($result))
                            @foreach($result as $item)
                                @php
                                    $randomKey = time().$loop->index;
                                @endphp

                                <livewire:admin.site-wide-search-item :item="$item" :keyword="$keyword" />
                            @endforeach
                        @endif
                    </div>
                @endif

            </div>
        </div>
    @endif

</div>
