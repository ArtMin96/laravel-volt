<x-admin.layouts.app>

    <x-admin.page-heading title="Add user" caption="Your user creation template."></x-admin.page-heading>

    <div class="row">
        <div class="col-12 col-xl-8">
            <div class="card card-body shadow-sm mb-4">
                <h2 class="h5 mb-4">General information</h2>
                <form wire:submit.prevent="add" action="#" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="first_name">First Name</label>
                                <input wire:model="first_name" class="form-control " id="first_name" type="text" placeholder="Enter your first name" required="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="last_name">Last Name</label>
                                <input wire:model="last_name" class="form-control " id="last_name" type="text" placeholder="Also your last name" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input wire:model="email" class="form-control " id="email" type="email" placeholder="name@company.com">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="password">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon4"><span class="fas fa-unlock-alt"></span></span>
                                <input wire:model.lazy="password" type="password" placeholder="Password" class="form-control " id="password">
                            </div>
                        </div>
                        <div class="col-md-6 form-group mb-4">
                            <label for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon5"><span class="fas fa-unlock-alt"></span></span>
                                <input wire:model.lazy="passwordConfirmation" type="password" placeholder="Confirm Password" class="form-control" id="confirm_password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-admin.layouts.app>
