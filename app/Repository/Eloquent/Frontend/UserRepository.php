<?php

namespace App\Repository\Eloquent\Frontend;

use App\Models\User;
use App\Repository\Eloquent\BaseRepository;
use App\Repository\Frontend\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var User $model
     */
    protected \Illuminate\Database\Eloquent\Model $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
