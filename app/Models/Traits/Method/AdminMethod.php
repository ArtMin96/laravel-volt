<?php

namespace App\Models\Traits\Method;

trait AdminMethod
{
    /**
     * Fix "only can() or $user->can() will work perfectly with Gate::before"
     *
     * @param array $permissions
     * @return bool
     */
    public function canDoAny(array $permissions): bool
    {
        foreach($permissions as $e){
            if($this->can($e)) return true;
        }

        return false;
    }

    /**
     * Fix "only can() or $user->can() will work perfectly with Gate::before"
     *
     * @param array $permissions
     * @return bool
     */
    public function canDoAll(array $permissions): bool
    {
        foreach($permissions as $e){
            if(!$this->can($e)) return false;
        }

        return true;
    }
}
