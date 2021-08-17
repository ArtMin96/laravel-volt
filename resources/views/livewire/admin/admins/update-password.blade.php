<form wire:submit.prevent="changePassword">

    <x-admin.alert />

    <div class="row">
        <div class="col-12 mb-3">
            <div>
                <label for="current_password">{{ __('admin/form.update-password.current_password') }}</label>
                <input wire:model="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" type="password" placeholder="{{ __('admin/form.update-password.current_password_placeholder') }}" required="">

                @error('current_password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-3">
            <div>
                <label for="password">{{ __('admin/form.update-password.password') }}</label>
                <input wire:model="password" class="form-control @error('password') is-invalid @enderror" id="password" type="password" placeholder="{{ __('admin/form.update-password.password_placeholder') }}" required="">

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 mb-3">
            <div class="form-group">
                <label for="confirm_password">{{ __('admin/form.update-password.confirm_password') }}</label>
                <input wire:model="passwordConfirmation" class="form-control @error('passwordConfirmation') is-invalid @enderror" id="confirm_password" type="password" placeholder="{{ __('admin/form.update-password.confirm_password_placeholder') }}">

                @error('passwordConfirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-gray-800 mt-2 animate-up-2">{{ __('admin/form.save') }}</button>
</form>
