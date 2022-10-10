<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productName', 'modelNumber', 'category', 'brand', 'cost',  'whole', 'quantity','online','retail', 'description','product_images[]',
    ];
    
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function invoices(){
        return $this->hasMany(InvoiceRow::class);
    }
    

}
