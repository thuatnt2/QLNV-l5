<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    private $category;


    public function __construct(Repository $category) 
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->all();

        return view('categories.index', compact('categories'));
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
    public function store(CategoryRequest $request)
    {
        try {

            $this->category->create($request->only('description', 'symbol'));

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
        try {

            $category = $this->category->findById($id);

            return view('categories.edit', compact('category'));
            
        } catch (Exception $e) {
            
            return redirect()->back()->withInput()->with('error', 'Không thể thao tác với ');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {

            $this->category->update($id, $request->only('description', 'symbol'));

            return redirect()->back();
            
        } catch (Exception $e) {

             return redirect()->back()->withInput()->with('error', 'Không thể thao tác với ');
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

            $this->category->delete($id);
            return redirect()->back();
            
        } catch (Exception $e) {
            
            return redirect()->back()->with('error', 'Không thể thao tác với Database');
        }
    }
}
