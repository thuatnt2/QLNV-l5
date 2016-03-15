<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Order;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;
class StatisticController extends Controller
{

    private $order;

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
        return view('statistics.index');
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
        $reportrange = array_reverse(explode('-', $request['reportrange']));
        $startDate = Carbon::createFromFormat('d/m/Y', trim($reportrange[1]))->toDateString();
        $endDate =  Carbon::createFromFormat('d/m/Y', trim($reportrange[0]))->toDateString();
        $result = $this->order->statistics($startDate, $endDate);
        return view('statistics.index', compact('result', 'reportrange'));
    }
    public function exportExcel()
    {
        $date = request()->input('date');
        $arrayDate = str_split( $date, 8);

        $startDate = $this->order->stringToDate($arrayDate[0]); 
        $endDate = $this->order->stringToDate($arrayDate[1]);
        $orderRepo = new OrderRepository(new Order);

        $data = $orderRepo->statistics($startDate, $endDate);
        Excel::create($date, function($excel) use ($data) {

        // Call them separately
        $excel->setDescription('File created by TNT');
        // Set top, right, bottom, left
        $excel->sheet('tnt', function($sheet) use ($data) {
            $sheet->setPageMargin(array(
                0.75, 0.75, 0.75, 1.25
            ));
            // Font family
            $sheet->setFontFamily('Times New Roman');
            // Font size
            $sheet->setFontSize(12);
            $sheet->loadView('statistics.output', ['result' => $data]);
        });
        })->export('xlsx');
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
