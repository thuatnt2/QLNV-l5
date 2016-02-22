<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ShipRequest;
use App\Order;
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
        'page_number',
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
            $orders = $this->order->findAllBy('warning');
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
        $ships = $this->ship->paginate(1);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipRequest $request)
    {
        try {
            $this->ship->create($request->only($this->dataGet));
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
        //
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
