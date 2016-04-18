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
    }

    public function index() 
    {
    	$users = $this->users->formatData($this->users->all(['id as id', 'fullname as symbol']));
    	$orders = $this->orders->formatData($this->orders->findAllManager('success', 'monitor',['id as id','order_name as symbol']));
    	$managers = $this->orders->findAllManager('success', 'monitor', [ '*'], true);

    	return view('managers.index', compact('users', 'orders', 'managers'));
    }

    public function store(Request $request)
    {
    	$this->orders->updateManager($request->only('user', 'order'));

    	return redirect()->back();
    }

    public function edit($id)
    {
    	// find order manager by user_id
    	
    	return view('managers.edit', compact());
    }

    public function update($id)
    {
    	# code...
    }

    public function show()
    {

    	return view('dashboard');
    }
}
