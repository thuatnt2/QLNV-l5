<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Order;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\File;
use App\Repositories\FileRepository;

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
            $users = $this->user->formatData($this->user->all(['id as id', 'name as symbol' ]));
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
