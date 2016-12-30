<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Repositories\OrderRepository;
use App\Contracts\findById;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Jobs\OfficeConversion;
use App\Phone;
use Carbon\Carbon;
use App\Order;
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
    public function importExcel()
    {
        $fileInfo = $this->uploadFile(request()->file('file'), 'import');
        $pathToFile = $fileInfo['path']. '/'. $fileInfo['name'];
        Excel::selectSheets('Sheet1')->load($pathToFile, function ($reader)
        {
            $rows = $reader->get();
            foreach ($rows as $key => $value) {
                $order = $this->excelForOrder($value, 'monitor');
                // insert into order table
                $newOrder = new OrderRepository(new Order);
                $newOrder->create($order);
            }
           
        });
        return redirect()->back();
    }
    public function exportExcel($value='')
    {
        # code...
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
        // update status cut order when all number not connect
        if($request->get('status') == 'danger') {
            $flag = true;
            foreach ($order->phones as $index => $phone) {
                if($phone->status != 'danger') {
                    $flag = false;
                }
            }
            if($flag) {
                $order->date_cut = Carbon::now();
                $order->save();
            }
        }

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
