<?php

namespace App\Console\Commands\Admin;

use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthPermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:permission {name} {display_name} {description} {--R|remove}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions = $this->generatePermissions();

        DB::beginTransaction();

        try {

            # Check if its remove
            if ($isRemove = $this->option('remove')) {
                # Remove permission
                if (Permission::findByName($this->getNameArgument())->delete()) {
                    $this->warn('Permissions ' . implode(', ', $permissions) . ' deleted.');
                } else {
                    $this->warn('No permissions for ' . $this->getNameArgument() .' found!');
                }
            } else {
                # create permissions
                foreach ($permissions as $permission) {
                    Permission::firstOrCreate([
                        'name' => $permission,
                        'display_name' => $this->buildTranslatedFields(Str::ucfirst(Str::replace('_', ' ', $permission))),
                        'description' => $this->buildTranslatedFields(Str::ucfirst(Str::replace('_', ' ', $permission))),
                        'guard_name' => 'admin',
                    ]);
                }

                $this->info('Permissions ' . implode(', ', $permissions) . ' created.');
            }

            # sync role for admin
            if($role = Role::findByName('admin', 'admin')) {
                $role->syncPermissions(Permission::all());
                $this->info('Admin permissions');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * @return array
     */
    private function generatePermissions(): array
    {
        $abilities = ['view', 'add', 'edit', 'delete'];
        $name = $this->getNameArgument();

        return collect($abilities)
            ->map(fn ($value) => $value . '_' . $name)
            ->all();
    }

    /**
     * @return string
     */
    protected function getNameArgument(): string
    {
        return Str::lower(Str::plural($this->argument('name')));
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
