<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Admin\Permission;
use App\Models\Admin\PermissionsGroup;
use App\Models\Admin\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $group) {
            $permissionGroup = PermissionsGroup::create([
                'name' => $group['name']
            ]);

            if ($permissionGroup) {
                foreach ($group['permissions'] as $permission) {
                    $permission = array_merge(
                        ['group_id' => $permissionGroup->id],
                        ['default' => true],
                        $permission
                    );

                    Permission::firstOrCreate($permission);
                }
            }
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for admin user, default is admin, manager and system_administrator? [y|N]', true)) {

            // Ask for roles from input
            $inputRoles = $this->command->ask('Enter roles in comma separate format.', 'Admin,Manager');

            // Explode roles
            $rolesArray = explode(',', $inputRoles);

            // add roles
            foreach($rolesArray as $role) {
                $role = Role::create([
                    'name' => trim($role),
                    'display_name' => $this->buildTranslatedFields($role),
                    'description' => $this->buildTranslatedFields($role),
                    'guard_name' => 'admin',
                    'default' => true,
                ]);

                if($role->name == 'admin') {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createAdminUser($role);
            }

            $this->command->info('Roles ' . $inputRoles . ' added successfully');
        } else {
            foreach (['admin', 'manager', 'system_administrator'] as $roleName) {
                $role = Role::create([
                    'name' => $roleName,
                    'display_name' => $this->buildTranslatedFields(Str::ucfirst(Str::replace('_', ' ', $roleName))),
                    'description' => $this->buildTranslatedFields(Str::ucfirst(Str::replace('_', ' ', $roleName))),
                    'guard_name' => 'admin',
                    'default' => true,
                ]);

                if ($roleName == 'admin') {
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                }

                // create one user for each role
                $this->createAdminUser($role);
            }

            $this->command->info('Added only default admin, manager, system_administrator role.');
        }

        $superAdminRole = Role::create([
            'name' => 'super_admin',
            'display_name' => [
                'en' => 'Super admin',
                'ru' => 'Супер админ',
                'hy' => 'Սուպեր ադմինիստրատոր',
            ],
            'description' => [
                'en' => 'Administrators with this role have access to everything in ' . config('app.name') . '. They can manage roles and role assignments. Also, they can create, edit, assign and delete custom roles.',
                'ru' => 'Администраторы с этой ролью имеют доступ ко всему на ' . config('app.name') . '. Они могут управлять ролями и назначениями ролей. Кроме того, они могут создавать, редактировать, назначать и удалять собственные роли.',
                'hy' => 'Այս դերն ունեցող ադմինիստրատորներին հասանելի է ամեն ինչ ' . config('app.name') . '-ում: Նրանք կարող են կառավարել դերեր և դերերի հանձնարարություններ: Բացի այդ, նրանք կարող են ստեղծել, խմբագրել, նշանակել և ջնջել հատուկ դերեր:',
            ],
            'guard_name' => 'admin',
            'default' => true,
        ]);

        $superAdminRole->syncPermissions(Permission::all());
        $this->command->info('Super Admin granted all the permissions');

        $superAdmin = Admin::first();

        $superAdmin->assignRole($superAdminRole->name);

        $this->command->info($superAdmin->email . ' assigned to the role of Super admin');

        $this->command->warn('All done :)');
    }

    /**
     * Create admin user with given role
     *
     * @param $role
     */
    private function createAdminUser($role)
    {
        $user = Admin::factory()->create();

        $user->assignRole($role->name);

        if($role->name == 'admin') {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($user->email);
            $this->command->warn('Password is "password"');
        }
    }

    /**
     * @param $value
     * @return array
     */
    private function buildTranslatedFields($value): array
    {
        return collect(getSupportedLanguagesKeys())->map(function ($localeCode) use ($value) {
            return [$localeCode => $value];
        })->collapse()->all();
    }
}
