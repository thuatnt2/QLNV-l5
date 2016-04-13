<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contracts\Repository;
use App\Contracts\findById;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Jobs\OfficeConversion;
use App\Kind;
use App\Order;
use App\Phone;
use App\Purpose;
use App\Repositories\CategoryRepository;
use App\Repositories\KindRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PurposeRepository;
use App\Repositories\UnitRepository;
use App\Unit;
use Auth;
use Carbon\Carbon;
use Excel;
use File;
use Illuminate\Http\Request;
use Response;
class OrderController extends Controller
{
    protected $order;
    protected $unit;

    protected $dataGet = [
                        'created_at',
                        'number_cv',
                        'number_cv_pa71',
                        'user',
                        'kind',
                        'unit',
                        'category',
                        'purpose',
                        'order_name',
                        'order_phone',
                        'date_request',
                        'customer_name',
                        'customer_phone',
                        'comment'
                        ];

    public function __construct(Repository $order)
    {
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request()->input('perPage', 10);
        $condition = request()->input('condition', '');
        $orders = $this->order->paginate($perPage, $condition);
        $orders->appends(['perPage' => $perPage, 'condition' => $condition]);
        return view('orders.index', compact('orders', 'condition'));
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
                $order['user'] = Auth::user()->id;
                $today = Carbon::now();
                $order['created_at'] = $today->day. '/'. $today->month. '/'. $today->year;
                $kind = new KindRepository(new Kind);
                $order['kind'] = $kind->findBy('symbol', $value['tinh_chat'],['id'])->id;
                $category = new CategoryRepository(new Category);
                $order['category'] = $category->findBy('symbol', $value['loai_dt'],['id'])->id;
                $unit = new UnitRepository(new Unit);
                $order['unit'] = $unit->findBy('symbol', $value['donviyc'], ['id'])->id;
                $purpose = new PurposeRepository(new Purpose);
                $order['purpose'] = $purpose->findBy('group', 'monitor', ['id'])->id;
                
                $order['number_cv'] = (int) $value['cvde'];
                $order['number_cv_pa71'] = (int) $value['cvdi'];
                $order['order_name'] = $value['ho_ten_dt'];
                $order['order_phone'] = [$value['so_dt']];
                $order['date_request'] = $value['ngay_bd']->day . '/'. $value['ngay_bd']->month. '/'.$value['ngay_bd']->year .'-'. $value['ngaykt']->day . '/'. $value['ngaykt']->month. '/'.$value['ngaykt']->year;
                $order['customer_name'] = $value['tents'];
                $order['customer_phone'] = (int) $value['dtts'];
                $order['comment'] = "";

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
    public function store(OrderRequest $request)
    {
        try {
            if($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'orders');
                if($fileInfo) {
                   $this->order->create($request->only($this->dataGet), $fileInfo['name']);   
                }
            }
            else {

                $this->order->create($request->only($this->dataGet));
            }
            return redirect()->back();
            
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->error);
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
        $order = $this->order->findById($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->order->findById($id);
        
        return view('orders.edit', compact('order'));
    }

    public function editList($id)
    {
        $order = $this->order->findById($id);
        $checked = [];
        foreach ($order->purposes as $purpose) {
            $checked['purpose['.$purpose->id.']'] = true;
        }
        return view('orders.edit_list', compact('order', 'checked'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        try {
            if($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'orders');
                if ($fileInfo) {
                    $this->order->update($id, $request->only($this->dataGet), $fileInfo['name']);
                }
            }
            else {
                $this->order->update($id, $request->only($this->dataGet));    
            }
            
            return redirect()->back();
            
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
    }
    public function updateStatus(Request $request, $phoneId)
    {
        $phone = Phone::find($phoneId);
        $order = $this->order->findById($phone->order_id);
        $order->comment = $request->get('comment');
        $order->save();
        
        $phone->status = $request->get('status');
        $phone->save();

        return redirect()->back();
    }

    public function search()
    {
        $result = $this->order->search(request()->input('query'));
        return  response()->json($result);
    }
    public function readFile()
    {
        $urlPath = request()->path();
        $fileArray = pathinfo($urlPath);
        $fileName = $fileArray['filename'];
        $fileExtension  = $fileArray['extension'];
        $dirName = str_replace('file', '/data', $fileArray['dirname']) . '/';
        $baseName = $fileArray['basename'];
        $pathToFile = base_path(). $dirName . $baseName;

        if (File::isFile($pathToFile))
        {           
            if($fileExtension == "doc" || $fileExtension == "docx" || $fileExtension == "xlsx" || $fileExtension == "pptx")
            {
                return response()->download($pathToFile);
            }
            $file = File::get($pathToFile);
            $response = Response::make($file, 200);
            $content_types = [
                'application/octet-stream', // txt etc
                'application/msword', // doc
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', //docx
                'application/vnd.ms-excel', // xls
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
                'application/pdf', // pdf
            ];
            // using this will allow you to do some checks on it (if pdf/docx/doc/xls/xlsx)
            $response->header('Content-Type', $content_types);

            return $response;
        }
        dd('chiu rooi');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->order->delete($id);

        return redirect()->back();
    }

}
