<form wire:submit.prevent="updateProfileInformation">

    <x-admin.alert />

    <div class="row">
        <div class="col-md-6 mb-3">
            <div>
                <label for="first_name">{{ __('admin/form.admins.first_name') }}</label>
                <input wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" type="text" placeholder="{{ __('admin/form.admins.first_name_placeholder') }}" required="">

                @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div>
                <label for="last_name">{{ __('admin/form.admins.last_name') }}</label>
                <input wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" type="text" placeholder="{{ __('admin/form.admins.last_name_placeholder') }}" required="">

                @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="email">{{ __('admin/form.admins.email') }}</label>
                <input wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="name@company.com">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label for="role">{{ __('admin/form.admins.role') }}</label>
            <select wire:model="roleName" class="form-select @error('roleName') is-invalid @enderror" id="guard_name" aria-label="{{ __('admin/form.admins.role') }}">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->display_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('admin/form.save') }}</button>
</form>
