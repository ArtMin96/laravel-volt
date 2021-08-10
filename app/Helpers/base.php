<?php

if (! function_exists('user')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->check() ? auth()->user() : null;
    }
}

if (! function_exists('admin')) {
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function admin(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->guard('admin')->check() ? auth()->guard('admin')->user() : null;
    }
}
