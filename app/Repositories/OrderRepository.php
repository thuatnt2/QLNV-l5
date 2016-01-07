<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Order;

class OrderRepository extends AbstractRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        parent::__construct($this->order);
    }
}