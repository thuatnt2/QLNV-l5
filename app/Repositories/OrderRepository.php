<?php
namespace App\Repositories;

use App\Contracts\Repository;
use App\Order;
use App\Phone;
use Carbon\Carbon;
use DB;

class OrderRepository extends AbstractRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        parent::__construct($this->order);
    }
    public function findAllBy($status, $condition = '', $columns = ['*'])
    {
        return $this->order
                    ->with(['unit', 'phones' => function($q) use ($status) {
                        $q->where('status', '=', $status);
                    }])
                    ->whereHas('purpose', function($q) use ($condition) {
                        $q->where( 'group', '=' , $condition);
                    })
                    ->whereHas('phones', function($q) use ($status) {
                        $q->where( 'status', '=', $status);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get($columns);
    }

    public function search($query)
    {
        return $this->order
                    ->with('unit','phones')
                    ->where('order_name', 'like', '%'.$query.'%')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
    public function paginate($perPage = 5, $condition = '', $columns = ['*'])
    {
        $query = $this->order
                      ->with('unit', 'kind', 'category', 'user', 'phones', 'purpose')
                      ->orderBy('created_at', 'desc');
        if ($condition != '') {
            $query->where('purpose_id', $condition);
        }

        return $query->paginate($perPage, $columns);
    }

    public function statistics($startDate, $endDate)
    {
        // init query
        $query =  DB::table('orders')
                    ->where(function ($q) use ($endDate, $startDate)
                    {
                        $q->where('date_end', '>=', $endDate)
                          ->orWhere('date_order', '>=', $startDate); 
                    })
                    ->whereNull('orders.deleted_at');
        // init element copy
        $query1 = clone $query;
        $query2 = clone $query;
        $order = $query->count();

        $query = $query->join('purposes', 'orders.purpose_id', '=', 'purposes.id')
                       ->select(
                            'purposes.symbol',
                            DB::raw('count(orders.id) as purposeOrder')
                        );
        $query3 = clone $query;
        // count purposes order                  
        $purposes = $query->groupBy('purposes.group')
                          ->get();
        // sum new, sum page_new, sum page_list                  
        $total = $query1->join('phones', 'orders.id', '=', 'phones.order_id')
                        ->join('ships', 'phones.id', '=', 'ships.phone_id')
                        ->select(DB::raw('sum(news) as news'),
                            DB::raw('coalesce(sum(page_news),0) as pageNews'), 
                            DB::raw('coalesce(sum(page_list),0) as pageList'),
                            DB::raw('coalesce(sum(page_xmctb),0) as pageXmctb'),
                            DB::raw('coalesce(sum(page_imei),0) as pageImei')
                        )
                        ->whereNull('ships.deleted_at')    
                        ->get();
                        // dd($total);
        // count purpose order of unit                
        $purposeUnit = $query3->join('units', 'units.id', '=', 'orders.unit_id') 
                              ->select(
                                    'units.symbol', 
                                    DB::raw('count(orders.id) as purposeOrder')
                                )
                              ->groupBy('units.symbol')
                              ->get();
        $units = $query2->join('units', 'units.id', '=', 'orders.unit_id')
                        ->join('phones', 'orders.id', '=', 'phones.order_id')
                        ->join('ships', 'phones.id', '=', 'ships.phone_id')
                        ->distinct('orders.symbol')
                        ->select('units.symbol',
                            DB::raw('coalesce(sum(ships.news),0) as numberNews'),
                            DB::raw('coalesce(sum(ships.page_news),0) as pageNews'),
                            DB::raw('coalesce(sum(ships.page_list),0) as pageList'),
                            DB::raw('coalesce(sum(ships.page_xmctb),0) as pageXmctb'),
                            DB::raw('coalesce(sum(ships.page_imei),0) as pageImei')
                        )
                        ->whereNull('ships.deleted_at')  
                        ->groupBy('units.symbol')
                        ->get();
        foreach ($units as $index1 => $unit) {
            foreach ($purposeUnit as $key => $value) {
                if($value->symbol == $unit->symbol) {
                    $unit->total = $value->purposeOrder;
                }
            }
        }
        $startDate = Carbon::parse($startDate)->format('d/m/Y');
        $endDate = Carbon::parse($endDate)->format('d/m/Y');
        return compact('order', 'purposes', 'total', 'units', 'startDate', 'endDate');
    }
    public function create(array $input, $fileName = '')
    {

    	$this->order->user_id = $input['user'];
    	$this->order->kind_id = $input['kind'];
    	$this->order->category_id = $input['category'];
    	$this->order->unit_id = $input['unit'];
        $this->order->purpose_id = $input['purpose'];
    	$this->order->number_cv = $input['number_cv'];
    	$this->order->number_cv_pa71 = $input['number_cv_pa71'];
    	$this->order->order_name = $input['order_name'];
    	$this->order->customer_name = $input['customer_name'];
    	$this->order->customer_phone = $input['customer_phone'];
    	$this->order->date_order = Carbon::createFromFormat('d/m/Y', $input['created_at']);
        $this->order->file_name = $fileName;
    	$date_request = explode('-', $input['date_request']);
    	$this->order->date_end = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
    	$this->order->date_begin = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
    	$this->order->comment = $input['comment'];
    	$this->order->slug = str_slug($this->vn_str_filter($input['order_name']), '-');
        // check if purpose is xmctb
        if ($input['purpose'] == 2) {
            $this->order->category_id = null;
            $this->order->kind_id = null;
            $this->order->date_begin = null;
            $this->order->date_end = null;
        }
        $this->order->save();
        foreach ($input['order_phone'] as $phone) {
            $newPhone = new Phone();
            $newPhone->number = $phone;
            $newPhone->status = 'warning';
            $this->order->phones()->save($newPhone);
        }
    }

    public function update($id, array $input, $fileName = '')
    {
        $order = $this->findById($id);

        $order->user_id = $input['user'];
        $order->kind_id = $input['kind'];
        $order->category_id = $input['category'];
        $order->unit_id = $input['unit'];
        $order->purpose_id = $input['purpose'];
        $order->number_cv = $input['number_cv'];
        $order->number_cv_pa71 = $input['number_cv_pa71'];
        $order->order_name = $input['order_name'];
        $order->customer_name = $input['customer_name'];
        $order->customer_phone = $input['customer_phone'];
        $order->date_order = Carbon::createFromFormat('d/m/Y', $input['created_at']);
        $order->file_name = $fileName;
        $date_request = explode('-', $input['date_request']);
        $order->date_end = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
        $order->date_begin = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
        $order->comment = $input['comment'];
        // update Order
        $order->save();
        // update Phones
    }
}