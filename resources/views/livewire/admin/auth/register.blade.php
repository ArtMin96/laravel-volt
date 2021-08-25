<main>

    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <div wire:ignore.self class="row justify-content-center form-bg-image"
                 data-background-lg="{{ asset('assets/img/illustrations/signin.svg') }}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-3 h3">{{ __('admin/auth.register.page_title') }}</h1>
                        </div>
                        <form wire:submit.prevent="register" class="mt-4">

                            <!-- Field -->
                            <div class="form-group mb-4">
                                <label for="first_name">{{ __('admin/auth.first_name') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="first_name-addon1"><svg
                                            class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                            </path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                    </span>
                                    <input wire:model.lazy="first_name" type="text" class="form-control" placeholder="{{ __('admin/auth.first_name_placeholder') }}" id="first_name" autofocus required>
                                </div>
                                @error('first_name')
                                    <div wire:key="form" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- End of Field -->

                            <!-- Field -->
                            <div class="form-group mb-4">
                                <label for="last_name">{{ __('admin/auth.last_name') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="last_name-addon1"><svg
                                            class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                            </path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                    </span>
                                    <input wire:model.lazy="last_name" type="text" class="form-control" placeholder="{{ __('admin/auth.last_name_placeholder') }}" id="last_name" autofocus required>
                                </div>
                                @error('last_name')
                                    <div wire:key="form" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- End of Field -->

                            <!-- Field -->
                            <div class="form-group mb-4">
                                <label for="password">{{ __('admin/auth.password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="password-addon1">
                                        <svg
                                            class="icon icon-xs text-gray-600" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                      clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <input wire:model.lazy="password" type="password" class="form-control" placeholder="{{ __('admin/auth.password_placeholder') }}" id="password" autofocus required>
                                </div>
                                @error('password')
                                    <div wire:key="form" class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- End of Field -->

                            <!-- Field -->
                            <div class="form-group mb-4">
                                <label for="confirm_password">{{ __('admin/auth.confirm_password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="confirm_password-addon1">
                                        <svg
                                            class="icon icon-xs text-gray-600" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                      clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                    <input wire:model.lazy="passwordConfirmation" type="password" class="form-control" placeholder="{{ __('admin/auth.confirm_password_placeholder') }}" id="confirm_password" autofocus required>
                                </div>
                            </div>
                            <!-- End of Field -->

                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">{{ __('admin/base.sign_up') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
