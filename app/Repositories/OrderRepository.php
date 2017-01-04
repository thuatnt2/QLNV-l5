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
        $queryMonitor = $this->initQueryStatistics($startDate, $endDate);
        $queryOrther = $this->initQueryStatistics($startDate, $endDate, 'success', '');
        $query1 = clone $queryMonitor;
        $query2 = clone $queryOrther;
        $orderMonitor = $queryMonitor->count('orders.id');
        $orderNew = $queryMonitor->where(function($q) use ($startDate, $endDate){
                                        $q->Where('date_order', '>=', $startDate)
                                          ->where('date_order', '<=', $endDate); 
                                    })
                                ->count('orders.id');
        $orderClosed = $this->initQueryStatistics($startDate, $endDate, 'danger')
                            ->where(function($q) use ($startDate, $endDate){
                                        $q->Where('date_cut', '>=', $startDate)
                                          ->where('date_cut', '<=', $endDate); 
                                    })
                                    ->count('orders.id');
        $orderOther = $queryOrther->count('orders.id');
        $order = $orderMonitor + $orderOther;
        
        // var_dump($order);
        $purposes = $queryOrther->select(
                                    'purposes.symbol',
                                    DB::raw('count(orders.id) as purposeOrder')
                                )
                                ->groupBy('purposes.group')
                                ->get();
        $purposes = $this->formatPurposeOrder($purposes, 'giám sát', $orderMonitor);
        // sum new, sum page_new, sum page_list                  
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
                                   // var_dump($total[0]->news);
       //  foreach ($total as $key => $value) {
       //      $purposes = $this->formatPurposeOrder($purposes, 'Số bản tin', $value->news);
       //      $purposes = $this->formatPurposeOrder($purposes, 'Số trang tin', $value->pageNews);
       //      $purposes = $this->formatPurposeOrder($purposes, 'Số trang list', $value->pageList);
       //      $purposes = $this->formatPurposeOrder($purposes, 'Số trang xmctb', $value->pageXmctb);
       //      $purposes = $this->formatPurposeOrder($purposes, 'Số trang imei', $value->pageImei);
       // }
        

        // folow block
        $security = $this->statisticsFollowBlock($startDate, $endDate, "Khối An ninh", "AN");
        $police = $this->statisticsFollowBlock($startDate, $endDate, "Khối Cảnh sát", "CS");
        $blocks = compact('security', 'police');
        // stattistic follow units
        $unit1 = $query1->join('units', 'units.id', '=', 'orders.unit_id')
                        ->leftJoin('ships', 'phones.id', '=', 'ships.phone_id')
                        ->select(
                            'units.symbol',
                            DB::raw('count(distinct(orders.id)) as total'),
                            DB::raw('coalesce(sum(ships.news),0) as numberNews'),
                            DB::raw('coalesce(sum(ships.page_news),0) as pageNews')
                        )
                        ->whereNull('ships.deleted_at')  
                        ->groupBy('units.symbol')
                        ->get();
        $unit2 = $query2->join('units', 'units.id', '=', 'orders.unit_id')
                        ->select(
                            'units.symbol',
                            DB::raw('count(distinct(orders.id)) as total'),
                            DB::raw('coalesce(sum(ships.page_list),0) as pageList'),
                            DB::raw('coalesce(sum(ships.page_xmctb),0) as pageXmctb'),
                            DB::raw('coalesce(sum(ships.page_imei),0) as pageImei')
                        )
                        ->whereNull('ships.deleted_at')  
                        ->groupBy('units.symbol')
                        ->get();
        $unit3 = $unit1;               
        foreach ($unit2 as $key => $value) {
            foreach ($unit1 as $index => $item) {
                if ($value->symbol == $item->symbol) {
                    $value->total += $item->total;
                    $value->numberNews = $item->numberNews;
                    $value->pageNews = $item->pageNews;
                    array_splice($unit3, $index, 1);
                }
            }
        }
        $units = array_merge($unit2, $unit3);
        $startDate = Carbon::parse($startDate)->format('d/m/Y');
        $endDate = Carbon::parse($endDate)->format('d/m/Y');
        
        return compact('order', 'orderMonitor', 'orderOther', 'orderNew', 'orderClosed', 'purposes', 'total', 'shipDirector', 'blocks', 'units', 'startDate', 'endDate');
    }
    public function statisticsFollowBlock($startDate, $endDate, $nameBlock, $symbolBlock)
    {
        $query = $this->initQueryStatistics($startDate, $endDate, 'monitor');
        $resultMonitor = $this->queryBlock($query, $symbolBlock);
        $detail = $this->createStdObject();
        $detail = $this->formatBlockOrder($resultMonitor['detail'], $detail);

        $query = $this->initQueryStatistics($startDate, $endDate);
        $resultOrther = $this->queryBlock($query, $symbolBlock); 
        $detail = $this->formatBlockOrder($resultOrther['detail'], $detail);


        $total = $resultMonitor['total'] + $resultOrther['total'];             
        return compact('nameBlock', 'total', 'detail');
    }
    public function queryBlock($query, $symbolBlock) {

        $total = $query->join('units', 'units.id', '=', 'orders.unit_id')
                       ->where('units.block', $symbolBlock)
                       ->count();
        $detail = $query->join('kinds', 'kinds.id', '=', 'orders.kind_id')
                        ->join('categories', 'categories.id', '=', 'orders.category_id')
                        ->select(
                                'kinds.description',
                                'categories.symbol',
                                DB::raw('count(orders.kind_id) as total')
                            )   
                        ->groupBy('kinds.description')
                        ->groupBy('categories.symbol')
                        ->get(); 
        return compact('total', 'detail');
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
                                $q->Where('date_begin', '>=', $startDate)
                                  ->orwhere('date_end', '>=', $endDate); 
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
    public function initQueryStatistics($startDate, $endDate, $status = 'success', $purpose = 'monitor')
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
    public function createStdObject()
    {
        $kinds = Kind::all();
        $categories = Category::all();
        
        $result = [];
        foreach ($kinds as $key => $kind) {
            $obj = new \stdClass;
            
            $symbol = [];
            foreach ($categories as $key => $category) {
                $j = new \stdClass;
                $j->symbol = $category->symbol;
                $j->total = 0;
                array_push($symbol, $j);
            }
            $obj->description = $kind->description;
            $obj->symbol = $symbol;
            $obj->total = 0;
            array_push($result, $obj);
        } 
        return $result;
        
    }

    public function formatBlockOrder($param, $obj)
    {
       
        foreach ($param as $p) {
            foreach ($obj as $r) {
                if ($p->description == $r->description) {
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