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

    public function create(array $input)
    {
        dd($input);
    	$this->order->user_id = $input['user'];
    	$this->order->kind_id = $input['kind'];
    	$this->order->category_id = $input['category'];
    	$this->order->unit_id = $input['unit'];
    	$this->order->number_cv = $input['number_cv'];
    	$this->order->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->order->order_name = $input['order_name'];
    	$this->order->order_phone = $input['order_phone'];
    	$this->order->customer_name = $input['customer_name'];
    	$this->order->customer_phone = $input['customer_phone'];

        $this->order->save();

    }
}