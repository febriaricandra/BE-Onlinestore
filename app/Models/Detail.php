<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Product;

class Detail extends Model
{
    use HasFactory;
    protected $table = 'transaction_detail';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'total',
        'status',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
