<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Transaction;

class DetailController extends Controller
{
    //

    public function index(){
        $detail = Detail::all();
        return response()->json([
            'success' => true,
            'message' => 'List Data Detail',
            'data' => $detail
        ], 200);
    }

    public function store(Request $request){
        $detail = Detail::create([
            'transaction_id' => $request->transaction_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => "Pending",
        ]);

        if($detail){
            return response()->json([
                'success' => true,
                'message' => 'Detail Created',
                'data' => $detail
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Detail Failed to Save',
                'data' => $detail
            ], 409);
        }
    }

    public function getDetailTransactionByUser($user_id){
        $detail = Detail::whereHas('transaction', function($query) use($user_id){
                    $query->where('user_id', $user_id);
                })->get();
        if(count($detail) > 0){
            return response()->json([
                'success' => true,
                'message' => 'List Data Detail',
                'data' => $detail
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Data Detail Not Found',
                'data' => $detail
            ], 404);
        }
    }
    
}
