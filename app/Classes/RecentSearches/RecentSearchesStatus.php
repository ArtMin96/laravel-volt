<?php

namespace App\Classes\RecentSearches;

use Illuminate\Contracts\Config\Repository;

class RecentSearchesStatus
{
    protected bool $enabled = true;

    public function __construct(Repository $config)
    {
        $this->enabled = $config['recent-searches.enabled'];
    }

    public function enable(): bool
    {
        return $this->enabled = true;
    }

    public function disable(): bool
    {
        return $this->enabled = false;
    }

    public function disabled(): bool
    {
        return $this->enabled === false;
    }
}
