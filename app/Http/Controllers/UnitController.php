<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\UnitRequest;
use Illuminate\Http\Request;

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
        $units = $this->unit->all();

        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\UnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {

        $this->unit->create($request->only('description', 'symbol', 'block'));
        return redirect()->back();
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
        dd("tnt");
        die;
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
