<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Kind;

class KindRepository extends AbstractRepository
{
    protected $kind;

    public function __construct(Kind $kind)
    {
        $this->kind = $kind;
        parent::__construct($this->kind);
    }
}