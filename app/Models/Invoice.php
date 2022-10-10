<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'isPaid',
        'total',
        'customer_id'
    ];


    public function invoiceRows(){  
        return $this->hasMany(InvoiceRow::class);
    }


    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
