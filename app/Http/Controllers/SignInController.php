<?php
namespace App\Http\Controllers;
use App\ApiCallHistory;
use App\Models\DashboardModel;
use Illuminate\Http\Request;
use App\User;
use App\OauthAccessToken;
use Auth;
use Validator;


class SignInController{

 public function __construct()
 {

 }

 public function index()
 {
     return view('signin');
 }

    public function userAuthenticate(Request $request)
    {
        $validator = Validator::make(request()->input(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            if (Auth::check() && Auth::user()->role!="admin")
            {   Auth::logout();
                return redirect()->back()->with('error','Invalid user role');
            }
            return redirect('dashboard');
        }
        else
        {
            return redirect()->back()->with('error','Invalid user name and password');
        }
    }

    public function signOut()
    {
        Auth::logout();
        return redirect('/');
    }


}
