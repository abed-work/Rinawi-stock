<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'product_price',
        'product_quantity',
        'total'
    ];


    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }


    public function product(){
        return $this->belongsTo(Product::class);
    }
}
