<form wire:submit.prevent="save" method="POST">

    <x-admin.alert />

    <div class="row">
        <div class="col-md-6 mb-3">
            <div>
                <label for="name">{{ __('admin/form.roles.role_name') }}</label>
                <input wire:model.lazy="name" class="form-control " id="name" type="text" placeholder="Enter role name" required="">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="role">{{ __('admin/form.roles.guard') }}</label>
            <select wire:model.defer="guardName" wire:click="permissionsBySelectedGuard($event.target.value)" class="form-select mb-0 " id="guard_name" aria-label="{{ __('admin/form.roles.guard') }}">
                @foreach(listingGuards() as $guard)
                    <option value="{{ $guard }}">{{ $guard }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        @if(!empty(getSupportedLocales()))
            @foreach(getSupportedLocales() as $localeCode => $properties)
                <div class="col-md-4 mb-3">
                    <div>
                        <label for="display_name_{{ $localeCode }}">{{ __('admin/form.roles.role_display_name', ['language' => $properties['native']]) }}</label>
                        <textarea wire:model.lazy="inputs.{{ $localeCode }}.display_name" class="form-control " id="display_name_{{ $localeCode }}" placeholder="{{ __('admin/form.roles.role_display_name_placeholder') }}" required="" spellcheck="false"></textarea>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <hr>

    <div class="d-flex align-items-center">
        <h2 class="h5 mb-4">{{ __('admin/form.roles.permissions') }}</h2>

        @if(count($permissions) > 0)
            <div class="form-check form-check mb-3 ms-4">
                <input class="form-check-input" type="checkbox" wire:model="selectAllPermissions" id="select-all-permissions">
                <label class="form-check-label" for="select-all-permissions">
                    {{ __('admin/form.select_all') }}
                </label>
            </div>
        @endif
    </div>

    <div class="row">
        @forelse($permissions as $key => $group)
            @dd($permissions)

{{--            @forelse($group as $permission)--}}
{{--                <div class="col-md-3">--}}
{{--                    <div class="form-check">--}}
{{--                        <input class="form-check-input" type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}"--}}
{{--                               id="permission-{{ $permission->id }}"--}}
{{--                                @if($role && $role->permissions->contains($permission)) checked @endif>--}}
{{--                        <label class="form-check-label" for="permission-{{ $permission->id }}">--}}
{{--                            {{ $permission->display_name }}--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @empty--}}
{{--            @endforelse--}}
        @empty
            <div class="col-12">
                <h5 class="text-center text-muted">{{ __('admin/form.roles.empty_permissions', ['guard' => $guardName]) }}</h5>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('admin/form.save') }}</button>
    </div>
</form>
