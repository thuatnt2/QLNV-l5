<?php

namespace App\Http\Controllers;

use App\Contracts\Repository;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;

class UserController extends Controller
{
    protected $user;

    // public function __construct(Repository $user)
    // {
    //     $this->user = $user;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
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
        $validate = $this->validator($request->only('now_password', 'password', 'password_confirmation'));
        if($validate->fails()) {

            return redirect()->back()->withErrors($validate)->withInput();

        } else if (Hash::check($request->input('now_password'), Auth::user()->password)) {

            $user = User::find($id);
            $user->password = Hash::make($request->input('password'));
            $user->save();

            return redirect()->back()->with('success', 'update success');
        } else {

            return redirect()->back()->with('error', 'update error');
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
        //
    }

    protected function validator(array $data) {

        return Validator::make($data, [
                'now_password' => 'required',
                'password' => 'required|confirmed|different:now_password|min:3',
                'password_confirmation' => 'required_with:password|min:3',

            ]);
    }
}
