<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Ship;

class ShipRepository extends AbstractRepository
{
    protected $ship;

    public function __construct(Ship $ship)
    {
        $this->ship = $ship;
        parent::__construct($this->ship);
    }
}