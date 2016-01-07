<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\KindRequest;

class KindController extends Controller
{
    protected $kind;

    public function __construct(Repository $kind)
    {
        $this->kind = $kind;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kinds = $this->kind->all();

        return view('kinds.index', compact('kinds'));
        
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
    public function store(KindRequest $request)
    {
        try {
            
            $this->kind->create($request->only('description', 'symbol'));

            return redirect()->back();

        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', $this->errorDB);
            
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
        $kind = $this->kind->findById($id);

        return view('kinds.edit', compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KindRequest $request, $id)
    {
        dd('loi roi');
        try {

            $this->kind->update($id, $request->only('description', 'symbol'));

            return redirect()->action('KindController@index');
            
        } catch (Exception $e) {
            
            return redirect()->back()->withInput()->with('error', $this->errorDB);
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
        try {
            $this->kind->delete($id);

            return redirect()->back();

        } catch (Exception $e) {
            
        }
    }
}
