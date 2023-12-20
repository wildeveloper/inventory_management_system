<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            // Add other validation rules
        ]);
    
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }
    
        // Process form data if validation passes
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return response()->json(['success' => true]);
            
        }else{
            return response()->json(['success' => false]);
        }

        
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
