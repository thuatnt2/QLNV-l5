<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Contracts\findById;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Phone;
use App\Repositories\UnitRepository;
use Illuminate\Http\Request;


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
        $orders = $this->order->paginate(1, '<>');
        return view('orders.index', compact('orders'));
    }
    public function orderList()
    {
        $orders = $this->order->paginate(2);

        return view('orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     *
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            if($request->file('file')->isValid()) {
                $file = $request->file('file');    
                $alowedExtension = ['doc', 'docx', 'pdf', 'xls', 'xlsx'];
                $extention = $file->getClientOriginalExtension();
                $fileName = str_slug($request->get('order_name')) . '_' . \Carbon\Carbon::now()->timestamp . '.' . $extention;
                $destinationPath = public_path() . '/uploads/orders';
                if (in_array($extention, $alowedExtension)) {

                    $file->move($destinationPath, $fileName);
                };
                $this->order->create($request->only($this->dataGet), $fileName);
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
        $order = $this->order->findById($id);
        $checked = [];
        foreach ($order->purposes as $purpose) {
            $checked['purpose['.$purpose->id.']'] = true;
        }
        return view('orders.edit', compact('order', 'checked'));
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

            $this->order->update($id, $request->only($this->dataGet));

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
