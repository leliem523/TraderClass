<?php

namespace App\Modules\Seller\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use App\Modules\Seller\Models\Users_Model;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticate extends Controller{

    public function __construct()
    {
        //$className = explode("\\", get_class())[4];
       
    }

    // Get method login
    public function login()
    {
        if(Auth::guard('seller')->check()) {
            return redirect()->route('seller.dashboard.index');
        }
        return view('Seller::auth.index');
    }

    // Get method register
    public function register()
    {
        return view('Seller::auth.register');
     
    }

    // Post method login
    public function postLogin(loginRequest $request)
    {
        $validated = $request->validated();
        $auth = array(
            'email' => $validated['email'],
            'password' => $validated['password'],
        );

        if(Auth::guard('seller')->attempt($auth, true)) {
                Auth::guard('seller')->logoutOtherDevices( $validated['password']);
               return redirect()->route('seller.dashboard.index');
        }
            
            return redirect()->route('seller.auth.getLogin'); 
    }

    // Post method register
    public function postRegister(registerRequest $request)
    {
        $validated = $request->validated();
        $msg = '';
        $check_user_exist = Users_Model::where('email', $validated['email'])->first();
        if($check_user_exist) {
            $msg = 'Seller is exist !!';
            return view('Seller::auth.register', compact('msg'));
        }
        $user =Users_Model::create([
                    'fullname' => $validated['fullname'],
                    'email' => $validated['email'],
                    'password' => bcrypt($validated['password']),
                    'status' => 0,
                    'type' => 1,
                ]);
        if(!$user) {
            dd(111);
        }
        return view('Seller::auth.index');
    }

    public function logout()
    {
        Auth::guard('seller')->logout();
        if(!Auth::guard('seller')->check()) {
            return redirect()->route('seller.auth.getLogin');
        }
    }
   
}