<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('authToken')->accessToken;
            return response()->json([
                'success' => true,
                'status' => '200',
                'message' => 'Login Success',
                'data' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'status' => '401',
                'message' => 'Login Failed',
                'data' => ''
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $password = $request->password;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => 'user',
        ]);
        if($user){
            return response()->json([
                'success' => true,
                'status' => '201',
                'message' => 'User Created',
                'data' => $user
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'status' => '409',
                'message' => 'User Failed to Save',
                'data' => $user
            ], 409);
        }
    }
}
