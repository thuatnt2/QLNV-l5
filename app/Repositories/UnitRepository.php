<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Unit;

class UnitRepository extends AbstractRepository
{
    protected $unit;

    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
        parent::__construct($this->unit);
    }
}