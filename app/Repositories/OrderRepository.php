<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Order;
use App\Phone;
use Carbon\Carbon;

class OrderRepository extends AbstractRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        parent::__construct($this->order);
    }
    public function paginate($perPage = 5, $condition = '=', $columns = ['*'])
    {
        return $this->order
                    ->with('unit', 'kind', 'category', 'user', 'phones', 'purposes')
                    ->whereHas('purposes', function($q) use ($condition) {
                        $q->where( 'group', $condition , 'list');
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage, $columns);
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
    	$this->order->customer_name = $input['customer_name'];
    	$this->order->customer_phone = $input['customer_phone'];
    	$this->order->date_order = Carbon::createFromFormat('d/m/Y', $input['created_at']);
    	$date_request = explode('-', $input['date_request']);
    	$this->order->date_end = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
    	$this->order->date_begin = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
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