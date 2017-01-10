<?php
namespace App\Repositories;

use App\Category;
use App\Contracts\Repository;
use App\Kind;
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
    protected function queryAll($status, $condition)
    {
        return $query =  $this->order
                       ->with(['unit', 'phones' => function($q) use ($status) {
                            $q->where('status', $status);
                       }])
                       ->whereHas('purpose', function($q) use ($condition) {
                            $q->where( 'group', $condition);
                       })
                       ->whereHas('phones', function($q) use ($status) {
                            $q->where( 'status', $status);
                       })
                       ->orderBy('created_at', 'desc');
    }
    public function findAllBy($status, $condition = 'monitor', $columns = ['*'])
    {
        $query = $this->queryAll($status, $condition);
        
        return $query->get($columns);
    }
    public function findAllManager($status, $condition = '', $columns = ['*'], $manager = false)
    {
        $query = $this->queryAll($status, $condition);
        if ($manager) {
            $query->whereNotNull('manager');
        } else {
            $query->whereNull('manager');
        }

        return $query->get($columns);
    }

    public function findManagerBy($id, $columns = ['*'])
    {
         $query = $this->queryAll('success', 'monitor');

         return $query->where('manager', $id)
                      ->get($columns);
    }
    public function search($query)
    {
        $field = 'order_name';
        $isNumeric = preg_match("/\S*\d+\S*/", $query) ? true : false;
        if($isNumeric) {
            $field = 'number_cv';
        }
        return $this->order
                    ->with('unit','phones')
                    ->where($field, 'like', '%'.$query.'%')
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
    public function paginate($perPage = 5, $condition = '', $columns = ['*'])
    {
        $query = $this->order
                      ->with('unit', 'kind', 'category', 'user', 'phones', 'purpose')
                      ->orderBy('date_order', 'desc');
        if ($condition != '') {
            $query->where('purpose_id', $condition);
        }

        return $query->paginate($perPage, $columns);
    }

    public function statistics($startDate, $endDate)
    {
        // init query
        $queryMonitor = $this->initQueryStatistics($startDate, $endDate, 'monitor');
        $queryOrther = $this->initQueryStatistics($startDate, $endDate);
        $query1 = clone $queryMonitor;
        $query2 = clone $queryOrther;
        $orderMonitor = $queryMonitor->count('orders.id');
        $orderNew = $queryMonitor->where(function($q) use ($startDate, $endDate){
                                        $q->Where('date_order', '>=', $startDate)
                                          ->where('date_order', '<=', $endDate); 
                                    })
                                 ->count('orders.id');
        $orderClosed = $this->initQueryStatistics($startDate, $endDate, 'monitor')
                            ->where(function($q) use ($startDate, $endDate){
                                        $q->Where('date_cut', '>=', $startDate)
                                          ->where('date_cut', '<=', $endDate); 
                                    })
                            ->count('orders.id');
        $orderOther = $queryOrther->count('orders.id');
        $order = $orderMonitor + $orderOther;
        $total = DB::table('ships')->select(
                                        DB::raw('coalesce(sum(news),0) as news'),
                                        DB::raw('coalesce(sum(page_news),0) as pageNews'), 
                                        DB::raw('coalesce(sum(page_list),0) as pageList'),
                                        DB::raw('coalesce(sum(page_xmctb),0) as pageXmctb'),
                                        DB::raw('coalesce(sum(page_imei),0) as pageImei')
                                    )
                                   ->where('date_submit', '>=', $startDate)
                                   ->where('date_submit', '<=', $endDate)
                                   ->whereNull('ships.deleted_at')    
                                   ->get();
        $shipDirector = DB::table('ships')->select(
                                        DB::raw('coalesce(sum(news),0) as news'),
                                        DB::raw('coalesce(sum(page_news),0) as pageNews')
                                    )
                                   ->where('date_submit', '>=', $startDate)
                                   ->where('date_submit', '<=', $endDate)
                                   ->where('receive_name', 'like', '%PGĐ%')
                                   ->whereNull('ships.deleted_at')    
                                   ->get();
        // folow block
        $detailMonitor = $this->statisticsDetail($startDate, $endDate, 'monitor');
        $detailOther = $this->statisticsDetail($startDate, $endDate);
        $startDate = Carbon::parse($startDate)->format('d/m/Y');
        $endDate = Carbon::parse($endDate)->format('d/m/Y');
        
        return compact('order', 'orderMonitor', 'orderOther', 'orderNew', 'orderClosed', 'purposes', 'total', 'shipDirector', 'detailMonitor', 'detailOther', 'startDate', 'endDate');
    }
    public function statisticsDetail($startDate, $endDate, $purpose = '')
    {
        $security = $this->queryBlock($startDate, $endDate, $purpose, 'AN');
        $police = $this->queryBlock($startDate, $endDate, $purpose, 'CS');
              
        return compact('security', 'police');
    }
    public function queryBlock($startDate, $endDate, $purpose, $symbolBlock) {

        $units = [];
        $query = $this->initQueryStatistics($startDate, $endDate, $purpose);
        $query = $query->join('units', 'units.id', '=', 'orders.unit_id')
                       ->where('units.block', $symbolBlock);
        $query1 = clone $query;
        $detailPurpose = $query1->join('categories', 'categories.id', '=', 'orders.category_id')
                         ->select(
                                'units.symbol as unit',
                                'categories.symbol as category',
                                DB::raw('count(phones.id) as number'),
                                DB::raw('count(distinct orders.id) as total')
                            )   
                         ->groupBy('units.symbol')
                         ->groupBy('categories.symbol')
                         ->get();

        if ($purpose == 'monitor') {
            $detailNews = $query->leftJoin('ships', 'phones.id', '=', 'ships.phone_id')
                          ->select(
                                'units.symbol as unit',
                                DB::raw('coalesce(sum(ships.news),0) as numberNews'),
                                DB::raw('coalesce(sum(ships.page_news),0) as pageNews')
                          )
                          ->where('date_submit', '>=', $startDate)
                          ->where('date_submit', '<=', $endDate)
                          ->where('receive_name', 'not like', '%PGĐ%')
                          ->whereNull('ships.deleted_at')  
                          ->groupBy('units.symbol')
                          ->get();
        }
        else {
            $detailNews = $query->select(
                                'units.symbol as unit',
                                DB::raw('count(phones.id) as number'),
                                DB::raw('coalesce(sum(ships.page_xmctb),0) as pageXmctb'),
                                DB::raw('coalesce(sum(ships.page_imei),0) as pageImei'),
                                DB::raw('coalesce(sum(ships.page_list),0) as pageList')
                            )
                          ->where('date_submit', '>=', $startDate)
                          ->where('date_submit', '<=', $endDate)
                          ->whereNull('ships.deleted_at')  
                          ->groupBy('units.symbol')
                          ->groupBy('purposes.group')
                          ->get();
        }
        // var_dump($detailNews);
        $units = $this->formatDetail($detailPurpose, $detailNews);
        
        return $units;

    }
    public function statisticsAction()
    {

        return Phone::with('order', 'ships', 'order.unit')
                    ->whereHas('order.purpose', function($q) {
                        $q->where('group', 'monitor');
                    })
                    ->where('status','success')
                    ->get();
    }
    public function statisticsUnit($startDate, $endDate, $unitId = '', $purpose = '')
    {
        $query =  $this->order
                       ->with('unit', 'purpose', 'phones.ships');
        if($unitId != '') {
            $query = $query->whereHas('unit', function($q) use ($unitId) {
                                $q->where('units.id', $unitId);
                            });
        }
                       
        if ($purpose == "monitor") {
            $query = $query->whereHas('purpose', function($q){
                                $q->where('purposes.group', '=', 'monitor');
                             })
                           ->whereHas('phones', function($q) {
                                $q->where('status', 'success');
                           })
                           ->where(function($q) use ($startDate, $endDate){
                                $q->Where('date_begin', '<=', $endDate)
                                  ->orwhere('date_end', '>=', $startDate); 
                             });
        }
        else {
            $query = $query->whereHas('purpose', function($q){
                                $q->where('purposes.group', '<>', 'monitor');
                             })
                           ->whereHas('phones.ships', function($q) use ($startDate, $endDate) {
                                $q->where('date_submit', '>=', $startDate)
                                  ->where('date_submit', '<=', $endDate);
                             });
        }
                    
                    
        return $query->groupBy('orders.id')
                     ->get();       

    }
    public function statisticsAdvance($startDate, $endDate, $unitId, $purposes, $kindId) 
    {

    }
    public function initQueryStatistics($startDate, $endDate, $purpose = '')
    {
        $query = DB::table('orders')->join('purposes', 'orders.purpose_id', '=', 'purposes.id')
                                    ->join('phones', 'orders.id', '=', 'phones.order_id')
                                    ->distinct();
        if ($purpose == 'monitor') {
            $query = $query->where('purposes.group', $purpose)
                           ->where(function ($q) use ($endDate, $startDate){
                                $q->Where('date_begin', '<=', $endDate)
                                  ->where('date_end', '>=', $startDate); 
                            });
                           // ->where('phones.status', $status)
        }
        else {
            $query = $query->leftJoin('ships', 'phones.id', '=', 'ships.phone_id')
                           ->where('purposes.group', '<>', 'monitor')
                           ->where(function ($q) use ($endDate, $startDate){
                                $q->where('ships.date_submit', '>=', $startDate)
                                  ->Where('ships.date_submit', '<=', $endDate); 
                            });
        }
                                    
        return $query->whereNull('orders.deleted_at');
    }
    public function create(array $input, $fileName = '')
    {
    	$this->order->user_id = $input['user'];
    	$this->order->kind_id = $input['kind'];
    	$this->order->category_id = $input['category'];
    	$this->order->unit_id = $input['unit'];
        $this->order->purpose_id = $input['purpose'];
    	$this->order->number_cv = (int)$input['number_cv'];
    	$this->order->number_cv_pa71 = (int)$input['number_cv_pa71'];
    	$this->order->order_name = $input['order_name'];
    	$this->order->customer_name = $input['customer_name'];
    	$this->order->customer_phone = $input['customer_phone'];
    	$this->order->date_order = Carbon::createFromFormat('d/m/Y', $input['created_at']);
        $this->order->file_name = $fileName;
        if (isset($input['date_request'])) {
            $date_request = explode('-', $input['date_request']);
            $this->order->date_end = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
            $this->order->date_begin = Carbon::createFromFormat('d/m/Y', trim(array_pop($date_request)));
        }else {
            $this->order->date_begin = null;
            $this->order->date_end = null;
        }
    	
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
            $newPhone->number = trim($phone);
            $newPhone->status = 'warning';
            $this->order->phones()->save($newPhone);
        }

        return $this->order;
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
    public function updateManager(array $data)
    {
        foreach ($data['order'] as $key => $value) {
            $order = $this->findById($value);
            $order->manager = $data['user'];
            $order->save();
        }
    }

    public function formatPurposeOrder($purposes, $symbol, $value)
    {
        if($value > 0) {
            $obj = new \stdClass;
            $obj->symbol = $symbol;
            $obj->purposeOrder = $value;
            array_push($purposes, $obj);
        }
        return $purposes;
    }
    // return array
    public function formatUnitForPurpose($obj)
    {
        $unit = $this->createObject();
        $unit->number = $obj->number;
        foreach ($unit->categories as $key => $value) {
            if ($key == $obj->category) {
                $unit->categories[$key] = $obj->total;
            }
        }
        $unit->categories = $c;
        return $unit;
    }

    public function formatUnitForNews($unit, $obj)
    {
        
        // for news
        if (isset($obj->numberNews)) {
            $unit->news[0] = $obj->numberNews;
            $unit->news[1] = $obj->pageNews;
        }
        // for xmctb
        if (isset($obj->pageXmctb)) {
            $unit->xmctb[0] = $obj->number;
            $unit->xmctb[1] = $obj->pageXmctb;
        }
        // for imei
        if (isset($obj->pageImei)) {
            $unit->imei[0] = $obj->number;
            $unit->imei[1] = $obj->pageImei;
        }
        // for list
        if (isset($obj->pageList)) {
            $unit->list[0] = $obj->number;
            $unit->list[1] = $obj->pageList;
        }
        
        return $unit;
    }

    public function createObject() {

        $unit = new \stdClass;
        $categories = Category::all()->sortBy('symbol');
        $unit->unit = "";
        $unit->number = 0;
        $c = [];
        foreach ($categories as $key => $category) {
            $c[$category->symbol] = 0; 
        }
        $unit->categories = $c;
        $unit->news = [];
        $unit->xmctb = [];
        $unit->imei = [];
        $unit->list = [];

        return $unit;
    }
    public function formatDetail($detailPurpose, $detailNews) 
    {
        $results = [];
        if (count($detailPurpose) > 0) {
           
            array_push($results, $this->formatUnitForPurpose($categories, array_shift($detailPurpose)));
            foreach ($results as $unit) {
                foreach ($detailPurpose as $obj) {

                    if ($unit->unit == $obj->unit) {
                        $unit->number += $obj->number;
                        foreach ($unit->categories as $key => $category) {
                            if ($key == $obj->category) {
                                $unit->categories[$key] = $obj->total;
                            }
                        }

                    }
                    else {
                        array_push($results, $this->formatUnitForPurpose($categories, $obj));
                    }
                }
                
            }
        }
        if(count($detailNews) > 0) {

            if(count($results) == 0) {
                $unit = $this->createObject();
                $o = array_shift($detailNews);
                $unit->unit = $o->unit;
                array_push($results, $this->formatUnitForNews($unit, $o));    
            }
            
            foreach ($results as $unit) {
                foreach ($detailNews as $o) {
                    if ($unit->unit == $o->unit) {
                        $this->formatUnitForNews($unit, $o);
                    }
                    else {
                        $unit = $this->createObject();
                        $unit->unit = $o->unit;
                        array_push($results, $this->formatUnitForNews($unit, $o));
                    }
                }   
            }
        }
        
        
        return $results;
    }
    public function formatBlockOrder($param, $obj)
    {
       
        foreach ($param as $p) {
            foreach ($obj as $r) {
                if ($p->unit == $r->unit) {
                    foreach ($r->symbol as $key => $value) {
                        if ($value->symbol == $p->symbol) {
                            $value->total += $p->total;
                            $r->total += $p->total;
                        }
                    }
                }
            }
        }
        return $obj;
    }
}