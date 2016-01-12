<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\User;

class UserRepository extends AbstractRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        parent::__construct($this->user);
    }
}