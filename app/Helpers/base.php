<?php

if (! function_exists('multiEmptyCheck')) {
    /**
     * @param ...$arguments
     * @return bool
     */
    function multiEmptyCheck(...$arguments): bool
    {
        foreach($arguments as $argument)
            if(empty($argument))
                continue;
            else
                return false;
        return true;
    }
}

if (! function_exists('multiStringCheck')) {
    /**
     * @param ...$arguments
     * @return bool
     */
    function multiStringCheck(...$arguments): bool
    {
        foreach($arguments as $argument)
            if(is_string($argument))
                continue;
            else
                return false;
        return true;
    }
}

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
