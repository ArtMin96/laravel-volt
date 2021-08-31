<?php

use App\Models\Admin\Role;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

if (! function_exists('user')) {
    /**
     * @return Authenticatable|null
     */
    function user(): ?Authenticatable
    {
        return auth()->check() ? auth()->user() : null;
    }
}

if (! function_exists('admin')) {
    /**
     * @return Authenticatable|null
     */
    function admin(): ?Authenticatable
    {
        return auth()->guard('admin')->check() ?
            auth()->guard('admin')->user() :
            null;
    }
}

if (! function_exists('listingGuards')) {
    /**
     * @return Collection
     */
    function listingGuards(): Collection
    {
        return collect(config('auth.guards'))->keys();
    }
}

if (! function_exists('isRoleExist')) {

    function isRoleExist($name, $guard_name = null): bool
    {
        return collect(Role::findByName($name, $guard_name))->count() > 0;
    }
}

if (! function_exists('givenPermissions')) {
    /**
     * Convert role string to array by separator "|".
     *
     * @param $roleString
     * @return array
     */
    function givenPermissions($roleString): array
    {
        return Str::contains($roleString, '|') ? explode('|', $roleString) : [$roleString];
    }
}
