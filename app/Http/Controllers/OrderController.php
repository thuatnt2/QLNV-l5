<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Contracts\findById;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Repositories\UnitRepository;


class OrderController extends Controller
{
    protected $order;
    protected $unit;

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
        $orders = $this->order->paginate();
        return view('orders.index', compact('orders'));
    }
    public function orderList()
    {
        $orders = $this->order->all();

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
            $this->order->create($request->only(
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
                ));
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
        return view('orders.edit', compact('order'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
