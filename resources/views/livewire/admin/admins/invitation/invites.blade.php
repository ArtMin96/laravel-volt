<div class="col-12 col-xl-4">
    <div class="card card-body border-0 shadow mb-4">
        <h2 class="h5 mb-4">{{ __('admin/crud.admins.invite-user.invites_title') }}</h2>

        @if(count($invites) > 0)
            <ul class="list-group list-group-flush">
                @foreach($invites as $invite)
                    <li class="list-group-item bg-transparent py-3 px-0 @if(!$loop->last) border-bottom @endif">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <!-- Avatar -->
                                <a href="#" class="avatar-md">
                                    <img class="rounded" alt="{{ $invite->email }}" src="{{ "https://www.gravatar.com/avatar/".md5(strtolower(trim('artminasyanart96@gmail.com'))) }}">
                                </a>
                            </div>
                            <div class="col-auto px-0">
                                <div class="d-flex align-items-center">
                                    <h4 class="fs-6 text-dark mb-1">{{ $invite->email }}</h4>
                                    <span class="ms-2 text-muted small">{{ carbon($invite->created_at)->diffForHumans() }}</span>
                                </div>
                                <span class="small">
                                    @foreach($invite->roles_label as $key => $role)
                                        <span class="badge rounded-pill bg-primary p-2 px-3 fw-bolder mb-2 @if(!$loop->last) me-1 @endif">{{ $role }}</span>
                                    @endforeach
                                </span>
                            </div>
                            <div class="col text-end">
                                <button type="button" wire:click="cancelInvitation('{{ encrypt($invite->id) }}')" class="btn btn-sm btn-secondary d-inline-flex align-items-center">
                                    {{ __('admin/form.cancel') }}
                                </button>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{ $invites->links() }}
        @endif
    </div>
</div>
