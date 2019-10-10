<?php

namespace App\Repository;

use App\User;

/**
 * Class UserRepository
 * @package App\Repository
 */
class CartRepository extends AbstractRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function get(int $id)
    {
        return $this->user->where('id', $id)->first();
    }

    public function find(array $param = [])
    {
        return $this->user->where($param)->get();
    }

    public function all()
    {
        return $this->user->get();
    }
}
