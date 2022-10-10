<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'total'
    ];

    public function purchaseRows(){
        return $this->hasMany(PurchaseRow::class);
    }

}
