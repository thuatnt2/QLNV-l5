<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Order;
use App\Phone;

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
    	$this->order->user_id = $input['user'];
    	$this->order->kind_id = $input['kind'];
    	$this->order->category_id = $input['category'];
    	$this->order->unit_id = $input['unit'];
    	$this->order->number_cv = $input['number_cv'];
    	$this->order->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->order->order_name = $input['order_name'];
    	// $this->order->order_phone = $input['order_phone'];
       
    	$this->order->customer_name = $input['customer_name'];
    	$this->order->customer_phone = $input['customer_phone'];
    	$this->order->date_order = $input['created_at'];
        dd($this->order->date_order);
    	$date_request = explode('-', $input['date_request']);
    	$this->order->date_end = array_pop($date_request);
        $this->order->date_end->format('Y-m-d');
    	$this->order->date_begin = array_pop($date_request);
        $this->order->date_begin->format('Y-m-d');
    	$this->order->comment = $input['comment'];
    	$this->order->slug = str_slug($this->vn_str_filter($input['order_name']), '-');

        $this->order->save();

	    foreach ($input['order_phone'] as $phone) {
            $newPhone = new Phone();
            $newPhone->number = $phone;
            $newPhone->status = 'new';
            $this->order->phones()->save($newPhone);
        }
        $this->order->purposes()->sync($input['purpose']);


    }
}