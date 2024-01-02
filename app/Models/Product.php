<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'jenis',
        'satuan',
        'category_product_id'
        
    ];

    public function category_product(){
        return $this->belongsTo(CategoryProduct::class);
    }

    public function cart_product(){
        return $this->hasMany(CartProduct::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

     public function resepproduct()
    {
        return $this->hsMany(ResepProduct::class);
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

}
