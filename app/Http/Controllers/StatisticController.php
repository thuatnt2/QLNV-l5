<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Order;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Excel;
use PDF;
use Illuminate\Http\Request;
class StatisticController extends Controller
{

    private $order;

    public function __construct(Repository $order)
    {
        $this->order = $order;
    }
    /**
     * Display a Form for input time report.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReport()
    {
        return view('statistics.report');
    }
    /**
     * Display a Form for input time report.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAction()
    {
        $result = $this->order->statisticsAction();
        return view('statistics.action', compact('result'));
    }
    /**
     * Display a Form for input time report.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUnit()
    {
        return view('statistics.unit');
    }
    public function getAdvance() 
    {
        return view('statistics.advance');
    }
    /**
     * process request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReport(Request $request)
    {
        $reportrange = array_reverse(explode('-', $request['reportrange']));
        $startDate = Carbon::createFromFormat('d/m/Y', trim($reportrange[1]))->toDateString();
        $endDate =  Carbon::createFromFormat('d/m/Y', trim($reportrange[0]))->toDateString();
        $result = $this->order->statistics($startDate, $endDate);
        return view('statistics.report', compact('result', 'reportrange'));
    }

    public function postUnit(Request $request)
    {
        $unitId = $request['unit'];
        $reportrange = array_reverse(explode('-', $request['reportrange']));
        $startDate = Carbon::createFromFormat('d/m/Y', trim($reportrange[1]))->toDateString();
        $endDate =  Carbon::createFromFormat('d/m/Y', trim($reportrange[0]))->toDateString();
        $monitor = $this->order->statisticsUnit($startDate, $endDate, $unitId, 'monitor');
        $orther =  $this->order->statisticsUnit($startDate, $endDate, $unitId);
        $result = $monitor->merge($orther);
        $result = $result->groupBy('purpose.symbol');
        return view('statistics.unit', compact('result', 'reportrange', 'unitId'));
    }

    public function postAdvance(Request $request) 
    {
        // if
    }
    public function exportExcel()
    {
        $date = request()->input('date');
        $arrayDate = str_split( $date, 8);

        $startDate = $this->order->stringToDate($arrayDate[0]); 
        $endDate = $this->order->stringToDate($arrayDate[1]);
        $orderRepo = new OrderRepository(new Order);
        if(request()->has('id')) {
            $unitId = request()->input('id');
            $monitor = $this->order->statisticsUnit($startDate, $endDate, $unitId, 'monitor');
            $orther =  $this->order->statisticsUnit($startDate, $endDate, $unitId);
            $data = $monitor->merge($orther);
            $data = $data->groupBy('purpose.symbol');
            $view = 'statistics.output_unit';
        }
        else {
            $data = $orderRepo->statistics($startDate, $endDate);
            $view = 'statistics.output';
        }
        
        Excel::create($date, function($excel) use ($view, $data) {
            // var_dump($data);
        // Call them separately
        $excel->setDescription('File created by TNT');
        // Set top, right, bottom, left
        $excel->sheet('tnt', function($sheet) use ($view, $data) {
            $sheet->setPageMargin(array(
                0.25, 0, 0, 0.5
            ));
            $sheet->setOrientation('landscape');
            // Font family
            $sheet->setFontFamily('Times New Roman');
            // Font size
            $sheet->setFontSize(14);
            $sheet->loadView($view, ['result' => $data]);
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
