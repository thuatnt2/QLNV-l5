<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Order;
use App\Repositories\OrderRepository;
use App\User;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $users = \DB::table('users')->join('orders', 'orders.manager', '=', 'users.id')
                                    ->join('phones', 'phones.order_id', '=', 'orders.id')
                                    ->where('phones.status', 'success')
                                    ->groupBy('orders.manager')
                                    ->select(
                                            'users.fullname',
                                            'users.id',
                                            \DB::raw(' count(manager) as total')
                                        )
                                    ->get();
        $orders = new OrderRepository(new Order);
        $managers = $orders->findAllManager('success', 'monitor', [ '*'], true);
        return view('home', compact('users', 'managers'));
    }
}
