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
        $transaction = Transaction::create([
            'courier' => $request->courier,
            'transfer' => $request->transfer,
            'user_id' => auth()->user()->id,
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
}
