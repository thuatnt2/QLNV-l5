<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UnitRequest;

class UnitController extends Controller
{
    private $unit;

    public function __construct(Repository $unit)
    {
        $this->unit = $unit;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $units = $this->unit->all();

            return view('units.index', compact('units'));

        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
        
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
     * @param  \Illuminate\Http\Request\UnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        try {

            $this->unit->create($request->only('description', 'symbol', 'block'));
            return redirect()->back();

        } catch (\Exception $e) {
            
            return redirect()->back()->withInput()->with('error', 'Không thể thêm dữ liệu');
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
        dd("show");
        die;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $unit = $this->unit->findById($id);
            return view('units.edit', compact('unit'));
            
        } catch (Exception $e) {
            
            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        try {
            $this->unit->update($id, $request->only('description', 'symbol', 'block'));

            return redirect()->action('UnitController@index');
            
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->unit->delete($id);

        return redirect()->back();
    }
}
