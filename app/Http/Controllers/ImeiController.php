<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Requests;
use App\Network;
use App\Order;
use App\Repositories\NetworkRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class ImeiController extends Controller
{
    protected $ship;
    protected $user;
    protected $order;
    protected $network;
    private $dataGet = [
        'created_at',
        'phone',
        'number_cv_pa71',
        'news',
        'page_news',
        'page_list',
        'page_imei',
        'network',
        'receive_name',
        'user_name'
    ];
    public function __construct(Repository $ship)
    {
        $this->ship = $ship;
        $this->user = new UserRepository(new User);
        $this->order = new OrderRepository(new Order);
        $this->network = new NetworkRepository(new Network);

        view()->composer(['imei.index', 'imei.edit'], function($view) {
            $users = $this->user->formatData($this->user->all(['id as id', 'name as symbol' ]));
            $orders = $this->order->findAllBy('warning', 'imei');
            $networks = $this->network->formatData($this->network->all(['id as id', 'name as symbol']));
            $view->with(array(
                'orders' => $orders,
                'users' => $users,
                'networks' => $networks
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
        $ships = $this->ship->paginate('imei', $perPage, ['phone', 'file']);
        $ships->appends(['perPage' => $perPage]);

        return view('imei.index', compact('ships'));
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
    public function store(Request $request)
    {
        try {
            // Co the chua bat dc exeption khi upload file
            if ($request->hasFile('file')) {
                $fileInfo = $this->uploadFile($request->file('file'), 'imei');
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
