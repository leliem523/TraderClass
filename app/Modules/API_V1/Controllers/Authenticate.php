<?php

namespace App\Modules\API_V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Authenticate extends Controller
{


     // Login api
     public function login(Request $request)
     {
         $fields = $request->validate([
             'email' => 'required|string',
             'password' => 'required|string',
         ]);
 
            // Check email
            $user = User::where('email', $fields['email'])->first();
        
            // Check password
            if(!$user || !Hash::check($fields['password'], $user->password)) {
                return Response([
                    'status' => false,
                    'msg' => 'logged in failed !!'
                ], 401);
            }
    
            $token = $user->createToken('ONICORNTOKENFORTRADERCLASS')->plainTextToken;
    
            return Response( [
                'status' => true,
                'msg' => 'Logged in successfully !!',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ]);
     }

    // register api
    public function register(Request $request)
    {
        $fields = $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(isset($user)) {
            return Response()->json([
                'status' => false,
                'msg' => 'User already exists !!',
            ]);
        }
        
        $user = User::create([
            'fullname' => $fields['fullname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('ONICORNTOKENFORTRADERCLASS')->plainTextToken;

        return response()->json([
            'status' => true,
            'msg' => 'register successfully !!',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ]);
    }
    //Logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return Response()->json([
            'status' => true,
            'msg' => 'Logged out successfully !!'
        ]);
        
    }

}