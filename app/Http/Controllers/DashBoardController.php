<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Order;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
	protected $users;
	protected $orders;
    public function __construct()
    {
    	$this->users = new UserRepository(new User);
    	$this->orders = new OrderRepository(new Order);
    	view()->composer(['managers.index', 'managers.edit'], function($view) {
            $users = $this->users->formatData($this->users->all(['id as id', 'fullname as symbol' ]));
            $orders = $this->orders->formatData($this->orders->findAllManager('success', 'monitor',['id as id','order_name as symbol']));
            $view->with(array(
                'orders' => $orders,
                'users' => $users
            ));
        });
    }

    public function index() 
    {
    	$managers = $this->orders->findAllManager('success', 'monitor', [ '*'], true);

    	return view('managers.index', compact('managers'));
    }

    public function store(Request $request)
    {
    	$this->orders->updateManager($request->only('user', 'order'));

    	return redirect()->back();
    }

    public function edit($id)
    {
    	// find order manager by user_id
    	$managers = $this->orders->formatData($this->orders->findManagerBy($id, ['id as id','order_name as symbol']));
    	// dd(array_keys($managers));
    	request()->session()->put('managers', $managers);
    	return view('managers.edit', compact('managers','id'));
    }

    public function update(Request $request)
    {
		$managers = $request->session()->pull('managers');
		$update = $request->only('user', 'order');
    	$this->orders->updateManager();

    	return redirect()->back();
    }

    public function show()
    {

    	return view('dashboard');
    }
}
