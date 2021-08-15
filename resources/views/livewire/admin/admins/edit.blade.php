<form wire:submit.prevent="updateProfileInformation" method="POST">

    <x-admin.alert />

    <div class="row">
        <div class="col-md-6 mb-3">
            <div>
                <label for="first_name">{{ __('admin/form.admins.first_name') }}</label>
                <input wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" type="text" placeholder="Enter your first name" required="">

                @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div>
                <label for="last_name">Last Name</label>
                <input wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" type="text" placeholder="Also your last name" required="">

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
                <label for="email">Email</label>
                <input wire:model="email" class="form-control @error('email') is-invalid @enderror" id="email" type="email" placeholder="name@company.com">
            </div>
        </div>
    </div>
</form>
