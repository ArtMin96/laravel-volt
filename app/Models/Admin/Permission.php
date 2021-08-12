<?php

namespace App\Models\Admin;

use Illuminate\Support\Collection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission as BasePermission;
use Spatie\Translatable\HasTranslations;

class Permission extends BasePermission
{
    use HasTranslations;

    public $translatable = ['display_name'];

    /**
     * @return array
     */
    public static function defaultPermissions(): array
    {

        return [
            [
                'name' => 'add_roles',
                'display_name' => [
                    'en' => 'Create roles',
                    'ru' => 'Создать роли',
                    'hy' => 'Ստեղծել դերեր',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'view_roles',
                'display_name' => [
                    'en' => 'View roles',
                    'ru' => 'Посмотреть роли',
                    'hy' => 'Դիտել դերերը',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'edit_roles',
                'display_name' => [
                    'en' => 'Edit roles',
                    'ru' => 'Изменить роли',
                    'hy' => 'Խմբագրել դերերը',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'delete_roles',
                'display_name' => [
                    'en' => 'Delete roles',
                    'ru' => 'Удалить роли',
                    'hy' => 'Ջնջել դերերը',
                ],
                'guard_name' => 'admin'
            ],

            [
                'name' => 'add_admins',
                'display_name' => [
                    'en' => 'Create admin users',
                    'ru' => 'Создать администратор пользователи',
                    'hy' => 'Ստեղծել ադմինիստրատոր օգտատեր',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'view_admins',
                'display_name' => [
                    'en' => 'View admin users',
                    'ru' => 'Посмотреть администратор пользователи',
                    'hy' => 'Դիտել ադմինիստրատոր օգտատերերին',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'edit_admins',
                'display_name' => [
                    'en' => 'Edit admin users',
                    'ru' => 'Изменить администратор пользователи',
                    'hy' => 'Խմբագրել ադմինիստրատոր օգտատերերին',
                ],
                'guard_name' => 'admin'
            ],
            [
                'name' => 'delete_admins',
                'display_name' => [
                    'en' => 'Delete admin users',
                    'ru' => 'Удалить администратор пользователи',
                    'hy' => 'Ջնջել ադմինիստրատոր օգտատեր',
                ],
                'guard_name' => 'admin'
            ]
        ];
    }

    /**
     * Permissions for CRUD
     *
     * Usage: Role::create(['name' => 'admin', 'display_name' => ['en' => 'Admin'], 'guard_name' => 'admin'])->givePermissionTo(
     *            Permission::createResource(['en' => 'Admin permission'], 'articles', 'authors')
     *        );
     *
     * @param array $displayName
     * @param ...$permissions
     * @return Collection
     */
    public static function createResource(array $displayName, ...$permissions): Collection
    {
        return collect($permissions)->flatten()->map(function ($permission) use ($displayName) {
            if (!is_string($permission)) {
                return false;
            }

            foreach (['index', 'create', 'store', 'show', 'edit', 'update', 'delete'] as $crud) {
                $array[] = [
                    'name' => "$crud $permission",
                    'display_name' => collect(LaravelLocalization::getSupportedLanguagesKeys())->flatten()->map(function ($locale) use ($displayName) {
                        return [$locale => $displayName[$locale]];
                    })->all(),
                    'guard_name' => 'admin'
                ];
            }

            foreach ($array as $crudPermission) {
                static::create($crudPermission);
            }
        });
    }
}
