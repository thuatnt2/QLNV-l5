<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Order;
use App\Phone;
use App\Repositories\FileRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ShipRepository;
use App\Repositories\UserRepository;
use App\Ship;
use App\User;
use DB;
use Excel;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $ship;
    protected $user;
    protected $order;

    private $dataGet = [
        'created_at',
        'phone',
        'number_cv_pa71',
        'news',
        'page_news',
        'page_list',
        'page_imei',
        'page_xmctb',
        'receive_name',
        'user_name'
    ];

    public function __construct(Repository $ship)
    {
        $this->ship = $ship;
        $this->user = new UserRepository(new User);
        $this->order = new OrderRepository(new Order);

        view()->composer(['news.index', 'news.edit'], function($view) {
            $users = $this->user->formatData($this->user->all(['id as id', 'fullname as symbol' ]));
            $orders = $this->order->findAllBy('success', 'monitor');
            $view->with(array(
                'orders' => $orders,
                'users' => $users
            ));
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request()->input('perPage', 10);
        $news = $this->ship->paginate('monitor', $perPage, ['phone', 'file']);
        $news->appends(['perPage' => $perPage]);
        return view('news.index', compact('news'));
    }
    public function importExcel()
    {
        $fileInfo = $this->uploadFile(request()->file('file'), 'import');
        $pathToFile = $fileInfo['path']. '/'. $fileInfo['name'];
        Excel::selectSheets('Sheet1')->load($pathToFile, function ($reader)
        {
            $rows = $reader->get();
            foreach ($rows as $key => $value) {
                // b1: find order with unit, order_name, order_phone
                $query = DB::table('orders')->join('units', 'orders.unit_id', '=', 'units.id')
                                            ->join('phones', 'orders.id', '=', 'phones.order_id')
                                            ->join('purposes', 'orders.purpose_id', '=', 'purposes.id')
                                            ->where('phones.number', $value['so_dien_thoai'])
                                            ->where('units.symbol', $value['don_vi_yc'])
                                            ->where('orders.order_name', 'like', '%'.$value['ho_ten_doi_tuong'].'%')
                                            ->where('purposes.group', 'monitor')
                                            ->select('phones.id');
                $order = $query->first();
                if (isset($order)) {
                    // up date status phone
                    $phone = Phone::find($order->id);
                    if ($phone->status != 'success') {
                        $phone->status = 'success';
                        $phone->save();
                    }
                    
                    $input = $this->excelForShip($value, $order->id);
                    $newShip = new ShipRepository(new Ship);
                    $newShip->create($input); 
                }
              
            }
        });
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try {
            $request->merge(array('news' => 1));

            if ($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'news');
                if ($fileInfo) {
                    $ship = $this->ship->create($request->only($this->dataGet), $fileInfo['original-name']);   

                    //save info file
                    $file = new FileRepository(new File);
                    $fileInfo['ship_id'] = $ship->id;
                    $file->create($fileInfo);
                }
            } 
            else {
                $this->ship->create($request->only($this->dataGet));        
            }
            return redirect()->back();

        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Xãy ra lỗi khi thêm dữ liệu');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = $this->ship->findById($id);

        return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->merge(array('news' => 1));
            if ($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'news');
                if ($fileInfo) {
                
                    $this->ship->update($id, $request->only($this->dataGet), $fileInfo['name']);
                }
            }
            else {

                $this->ship->update($id, $request->only($this->dataGet));    
            }

            return redirect()->back();
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->ship->delete($id);
        return redirect()->back();
    }
}
