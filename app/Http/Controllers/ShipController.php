<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\File;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ShipRequest;
use App\Order;
use App\Repositories\FileRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class ShipController extends Controller
{
    protected $ship;

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

        view()->composer(['ships.index', 'ships.edit'], function($view) {
            $users = $this->user->formatData($this->user->all(['id as id', 'name as symbol' ]));
            $orders = $this->order->findAllBy('warning', 'list');
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
        $ships = $this->ship->paginate( 'list',$perPage, ['phone', 'file']);
        $ships->appends(['perPage' => $perPage]);
        return view('ships.index', compact('ships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function importFile()
    {
        $fileInfo = $this->uploadFile(request()->file('file'), 'import');
        $pathToFile = $fileInfo['path']. '/'. $fileInfo['name'];
        Excel::selectSheets('Sheet1')->load($pathToFile, function ($reader)
        {
            $rows = $reader->get();

            foreach ($rows as $key => $value) {
                // $value is array
                $news['user'] = Auth::user()->id;
                $today = Carbon::now();
                $news['created_at'] = $today->day. '/'. $today->month. '/'. $today->year;
                $kind = new KindRepository(new Kind);
                $news['kind'] = $kind->findBy('symbol', $value['tinh_chat'],['id'])->id;
                $category = new CategoryRepository(new Category);
                $news['category'] = $category->findBy('symbol', $value['loai_dt'],['id'])->id;
                $unit = new UnitRepository(new Unit);
                $news['unit'] = $unit->findBy('symbol', $value['donviyc'], ['id'])->id;
                $purpose = new PurposeRepository(new Purpose);
                $news['purpose'] = $purpose->findBy('group', 'monitor', ['id'])->id;
                
                $news['number_cv'] = (int) $value['cvde'];
                $news['number_cv_pa71'] = (int) $value['cvdi'];
                $news['news_name'] = $value['ho_ten_dt'];
                $news['news_phone'] = [$value['so_dt']];
                $news['date_request'] = $value['ngay_bd']->day . '/'. $value['ngay_bd']->month. '/'.$value['ngay_bd']->year .'-'. $value['ngaykt']->day . '/'. $value['ngaykt']->month. '/'.$value['ngaykt']->year;
                $news['customer_name'] = $value['tents'];
                $news['customer_phone'] = (int) $value['dtts'];
                $news['comment'] = "";

                // insert into order table
                $newOrder = new OrderRepository(new Order);
                $newOrder->create($order);
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
    public function store(ShipRequest $request)
    {
        try {
            // Co the chua bat dc exeption khi upload file
            if ($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'ships');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ship = $this->ship->findById($id);
        
        return view('ships.edit', compact('ship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipRequest $request, $id)
    {
        try {
            if ($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'ships');
                // if upload success
                if ($fileInfo) {
                
                    $ship = $this->ship->update($id, $request->only($this->dataGet), $fileInfo['name']);

                    // update file table if isset
                    if (isset($ship->file)) {
                        $file = $ship->file;
                        $file->update($id, $fileInfo);
                    }
                    else {
                        //save info file
                        $file = new FileRepository(new File);
                        $fileInfo['ship_id'] = $ship->id;
                        $file->create($fileInfo);
                    }
                    
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
        $this->ship->delete($id, true);
        return redirect()->back();
    }
}
