<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()]);
        } else {
            //echo 'validation success';
            $cred = array('email' => $request->email, 'password' => $request->password);
            if (Auth::attempt($cred)) {
                $user = Auth::user();
                if (Auth::user()->hasRole('admin')) {
                    return response()->json(['status' => 200, 'message' => 'login success', 'url' => 'admin/dashboard']);
                } else {
                    Auth::logout();
                    return response()->json(['status' => 400, 'message' => 'you are not admin']);
                }
                // $token=$user->createToken('auth_token')->plainTextToken;
                // return response()->json(['status'=>'success','message'=>'login success','token'=>$token]);
            } else {
                return response()->json(['status' => 400, 'message' => 'Invalid Username and  password']);
            }
        }
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Invalid Inputs',
        //         'errors' => $validator->errors(),
        //     ], 422);
        // }
    }
}
