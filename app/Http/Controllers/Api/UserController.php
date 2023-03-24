<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'status' => '200',
            'message' => 'List Data User',
            'data' => $users
        ], 200);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
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
