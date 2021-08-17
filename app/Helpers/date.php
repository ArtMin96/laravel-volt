<?php

use Carbon\Carbon;

if (! function_exists('carbon')) {

    /**
     * Returns new Carbon object.
     *
     * @param mixed ...$args arguments
     *
     * @author Caleb Porzio <calebporzio@gmail.com>
     * @link   https://github.com/calebporzio/awesome-helpers
     *
     * @return \Illuminate\Support\Carbon|null
     */
    function carbon(...$args): ?Carbon
    {
        try {
            return new Carbon(...$args);
        } catch (Exception $exception) {
            return null;
        }
    }
}
