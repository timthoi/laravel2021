<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
//        $user = new User();
//        $user->first_name = 'joe';
//        $user->last_name = 'joe';
//        $user->phone = '123123213';
//        $user->email = 'joe@gmail.com';
//        $user->password = Hash::make('123456');
//
//        if ( ! ($user->save()))
//        {
//            dd('user is not being saved to database properly - this is the problem');
//        }
//
//        if ( ! (Hash::check('123456', Hash::make('123456'))))
//        {
//            dd('hashing of password is not working correctly - this is the problem');
//        }
//
//        if ( ! (Auth::attempt(array('email' => 'joe@gmail.com', 'password' => '123456'))))
//        {
//            dd('storage of user password is not working correctly - this is the problem');
//        }
//
//        else
//        {
//            dd('everything is working when the correct data is supplied - so the problem is related to your forms and the data being passed to the function');
//        }
//        var_dump($request);die;
    
        if (Auth::attempt($request->only('email','password'))) {
            $user = Auth::user();
            
            $token = $user->createToken('admin')->accessToken;
            
            return [
                'token' => $token,
            ];
        }
    
        return [
            'code' => 0,
            'msg' => 'Invalid Credentials',
            "data" => []
        ];
    }
    //
}
