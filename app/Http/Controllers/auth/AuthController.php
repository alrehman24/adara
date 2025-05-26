<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:4',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => $validator->errors()]);
        } else {
            //echo 'validation success';
            $cred = array('email' => $request->email, 'password' => $request->password);
            // Hash the password using Bcrypt before attempting authentication
            // $user = \App\Models\User::where('email', $request->email)->first();
            // if ($user) {
            //     $user->password = bcrypt($request->password);
            //     $user->save();
            // }
            if (Auth::attempt($cred)) {
                $user = Auth::user();

                if (Auth::user()->hasRole('admin')) {
                    return response()->json(['status' => 200, 'message' => 'login success', 'url' => 'admin/dashboard']);
                } else {
                    // Auth::logout();
                    // return response()->json(['status' => 200, 'message' => 'login success']);
                    // $user=User::find(Auth::user()->id)->first();
                    $user['token'] = $user->createToken('auth_token')->plainTextToken;
                    return $this->success([
                        ['user' => $user]
                    ], 'success login');
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
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:4'
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        }

        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);
        $customer = Role::where('slug', 'customer')->first();
        $user->roles()->attach($customer);
        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }
    public function updateUser(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'    => 'required|string|max:255'
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {

            $user = User::updateOrCreate(['id' => Auth::id(),], [
                'name' => $request->name
            ]);

            return $this->success([
                 'user'=>$user
            ],'updated successfully');
        }
    }
}
