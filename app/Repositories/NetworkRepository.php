<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Network;

class NetworkRepository extends AbstractRepository
{
    protected $network;

    public function __construct(Network $network)
    {
        $this->network = $network;
        parent::__construct($this->network);
    }
}