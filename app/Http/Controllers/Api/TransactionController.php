<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json([
            'success' => true,
            'status' => '200',
            'message' => 'List Data Transaction',
            'data' => $transactions
        ], 200);
    }

    public function store(Request $request)
    {
        $image_path = $request->file('transfer')->store('images', 'public');
        $transaction = Transaction::create([
            'courier' => $request->courier,
            'transfer' => $image_path,
            'user_id' => $request->user_id,
        ]);
        if($transaction){
            return response()->json([
                'success' => true,
                'status' => '201',
                'message' => 'Transaction Created',
                'data' => $transaction
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'status' => '409',
                'message' => 'Transaction Failed to Save',
                'data' => $transaction
            ], 409);
        }
    }

    public function showImage($namafile)
    {
        $thePath = public_path('storage/images/' . $namafile) ;
        return response()->file($thePath);
    }
}
