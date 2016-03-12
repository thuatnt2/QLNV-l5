<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Excel;
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
        $data = 10;
        Excel::create('tnt', function($excel) use ($data) {

        // Call them separately
        $excel->setDescription('A demonstration to change the file properties');
        $excel->sheet('First sheet', function($sheet) use ($data) {
            $sheet->row(1, array(
                'Tổng số yêu cầu thực hiện', $data
                ));
           
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
