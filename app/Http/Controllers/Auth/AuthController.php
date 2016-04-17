<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Validator;
use Hash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';
    protected $username = 'username';
    protected $user;
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Repository $user)
    {
        // $this->middleware('guest', ['except' => 'logout']);
        $this->user = $user;
        view()->composer(['auth.register', 'auth.edit_register'], function($view) {
            $roles = ['admin' => 'admin', 'employee' => 'employee'];
            $view->with(array(
                'roles' => $roles
            ));
        });
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getRegister()
    {
        $users = $this->user->all();
        
        return view('auth.register', compact('users'));
    }

    // public function postRegister(UserRequest $request)
    // {
        
    // }
    public function edit($id)
    {
        $user = $this->user->findById($id);

        return view('auth.edit_register', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        // ajax
        try {
            $this->user->update($id, $request->only('username', 'fullname', 'role'));

            return redirect()->action('Auth\AuthController@getRegister');
            
        } catch (Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Không thể truy vấn dữ liệu');
        }
    }
    public function destroy($id)
    {
        $this->user->delete($id);

        return redirect()->back();
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|unique:users|max:255',
            'fullname' => 'required|max:255',
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'role' => $data['role'],
            'password' => Hash::make("123456"),
        ]);
    }
}
