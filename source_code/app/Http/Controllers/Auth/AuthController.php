<?php

namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller
{
     use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
    protected function create(array $data)
    {
         return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }
    public function getLogin(){
        return view('Backend.login');

    }
    public function postLogin(LoginRequest $request){
  $login= array(
        'email' => $request->email,
        'password'=> $request->password,
        );


        if(Auth::attempt($login)){

              return \Redirect::to('quan-tri/');
        }else{
            return redirect()->back();
        }

    }
    public function getRegister(){
        return view('Backend.register');
    }
    public function postRegister(){
       $data = \Request::input();
        $user = new User();
        $user->user_name = $data['user_name'];
        $user->email =$data['email'];
        $user->password = bcrypt($data['password']);
        $user->remember_token = $data['_token'];
        $user->save();
        return redirect('login/');
    }
    public function postCheckExistEmail() {
        extract($_POST);
        $emailExist = User::where('email', $email)->get()->toArray();

        if (count($emailExist) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
     public function getLogout(){
        //dd(Auth::user());
        Auth::logout();
        return redirect()->back();
    }
}

