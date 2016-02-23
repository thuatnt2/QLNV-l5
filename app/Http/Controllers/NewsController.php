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

class NewsController extends Controller
{
    protected $news;
    protected $user;
    protected $order;

    private $dataGet = [
        'created_at',
        'phone',
        'number_cv_pa71',
        'number_news',
        'page_number',
        'receive_name',
        'user_name'
    ];

    public function __construct(Repository $news)
    {
        $this->news = $news;
        $this->user = new UserRepository(new User);
        $this->order = new OrderRepository(new Order);

        view()->composer(['news.index', 'news.edit'], function($view) {
            $users = $this->user->formatData($this->user->all(['id as id', 'name as symbol' ]));
            $orders = $this->order->findAllBy('success', '<>');
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
        $news = $this->news->paginate(1, ['phone', 'files', 'order']);
        return view('news.index', compact('news'));
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
    public function store(NewsRequest $request)
    {
        try {
            $this->news->create($request->only($this->dataGet));

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
        $this->news->delete($id);
        return redirect()->back();
    }
}
