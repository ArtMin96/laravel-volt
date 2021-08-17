<?php

namespace App\Models\Admin;

use App\Models\Traits\Relationship\PermissionRelationship;
use Illuminate\Support\Collection;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Permission\Models\Permission as BasePermission;
use Spatie\Translatable\HasTranslations;

class Permission extends BasePermission
{
    use HasTranslations,
        PermissionRelationship;

    public array $translatable = ['display_name'];

    /**
     * @return array
     */
    public static function defaultPermissions(): array
    {

        return [
            [
                'name' => [
                    'en' => 'Roles',
                    'ru' => 'Роли',
                    'hy' => 'Դերեր',
                ],

                'permissions' => [
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
                ],
            ],

            [
                'name' => [
                    'en' => 'Admins',
                    'ru' => 'Админы',
                    'hy' => 'Ադմինիստրատորներ',
                ],

                'permissions' => [
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
                    ],
                ],
            ],

            [
                'name' => [
                    'en' => 'Users',
                    'ru' => 'Пользователи',
                    'hy' => 'Օգտվողներ',
                ],

                'permissions' => [
                    [
                        'name' => 'add_users',
                        'display_name' => [
                            'en' => 'Create users',
                            'ru' => 'Создать пользователи',
                            'hy' => 'Ստեղծել օգտատեր',
                        ],
                        'guard_name' => 'admin'
                    ],
                    [
                        'name' => 'view_users',
                        'display_name' => [
                            'en' => 'View users',
                            'ru' => 'Посмотреть пользователи',
                            'hy' => 'Դիտել օգտատերերին',
                        ],
                        'guard_name' => 'admin'
                    ],
                    [
                        'name' => 'edit_users',
                        'display_name' => [
                            'en' => 'Edit users',
                            'ru' => 'Изменить пользователи',
                            'hy' => 'Խմբագրել օգտատերերին',
                        ],
                        'guard_name' => 'admin'
                    ],
                    [
                        'name' => 'delete_users',
                        'display_name' => [
                            'en' => 'Delete users',
                            'ru' => 'Удалить пользователи',
                            'hy' => 'Ջնջել օգտատեր',
                        ],
                        'guard_name' => 'admin'
                    ],
                ],
            ],

            [
                'name' => [
                    'en' => 'Dashboard',
                    'ru' => 'Панель приборов',
                    'hy' => 'Վահանակ',
                ],

                'permissions' => [
                    [
                        'name' => 'view_dashboard',
                        'display_name' => [
                            'en' => 'View dashboard',
                            'ru' => 'Просмотр панели управления',
                            'hy' => 'Դիտել վահանակը',
                        ],
                        'guard_name' => 'admin'
                    ],
                ]
            ],
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
