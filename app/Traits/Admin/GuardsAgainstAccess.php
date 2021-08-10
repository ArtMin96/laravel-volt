<?php

namespace App\Traits\Admin;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

trait GuardsAgainstAccess
{
    public function initializeGuardsAgainstAccess()
    {
        if (!App::runningInConsole() && !App::runningUnitTests()) {
            return;
        }

        if (isset($this->guard)) {
            abort_unless(Auth::guard($this->guard)->check(), 401);
        }
    }
}
