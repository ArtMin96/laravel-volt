<div class="card-body p-5">
    <h1 class="fs-4 card-title fw-bold mb-4">{{ __('Login') }}</h1>
    <form wire:submit.prevent="authenticate">

        <div class="mb-3">
            <label for="email" class="mb-2">{{ __('E-Mail Address') }}</label>

            <input wire:model.lazy="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">

            @if (Route::has('password.request'))
                <div class="mb-2 w-100">
                    <label class="text-muted" for="password">Password</label>
                    <a href="{{ route('password.request') }}" class="float-end">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

            <label for="password" class="mb-2">{{ __('Password') }}</label>

            <input wire:model.lazy="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex align-items-center">
            <div class="form-check">
                <input wire:model.lazy="remember" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <button type="submit" class="btn btn-primary ms-auto">
                {{ __('Login') }}
            </button>
        </div>

    </form>
</div>
