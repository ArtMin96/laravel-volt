<div class="col-12 col-xl-8">
    <form wire:submit.prevent="process">

        <x-admin.alert />

        <div class="row">
            <div class="col-12">
                <div class="card card-body shadow-sm mb-4">
                    <h2 class="h5 mb-4">{{ __('admin/crud.admins.invite-user.form_title') }}</h2>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div>
                                <label for="email">{{ __('admin/form.invite-user.email') }}</label>
                                <input wire:model.defer="email" class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="{{ __('admin/form.invite-user.email_placeholder') }}" required="">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role -->
        @if (count($this->roles) > 0)

            <div class="row">
                <div class="col-12">
                    <div class="card card-body shadow-sm mb-4">
                        <h2 class="h5 mb-4">{{ __('admin/crud.admins.invite-user.role_section_title') }}</h2>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <ul class="list-group list-group-flush">
                                    @foreach ($this->roles as $index => $role)
                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0 @if(!$loop->last) border-bottom @endif">
                                            <div>
                                                <h3 class="h6 mb-1">{{ $role->display_name }}</h3>
                                                <p class="small pe-4">{{ $role->description ?: '' }}</p>
                                            </div>
                                            <div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                           wire:model="selectedRole"
                                                           value="{{ $role->name }}"
                                                           type="checkbox"
                                                           id="role-{{ $role->name }}">
                                                    <label class="form-check-label" for="role-{{ $role->name }}"></label>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('admin/form.save') }}</button>
    </form>
</div>
