<?php

namespace App\Repository\Eloquent\Admin;

use App\Models\Admin;
use App\Repository\Admin\AdminRepositoryInterface;
use App\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    /**
     * @var Admin $model
     */
    protected \Illuminate\Database\Eloquent\Model $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
