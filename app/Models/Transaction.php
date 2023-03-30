<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'courier',
        'transfer',
        'user_id',
    ];

    public function product(){
        return $this->belongsToMany(Product::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
