<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_resep_id'
    ];

    public function category_resep(){
        return $this->belongsTo(CategoryResep::class);
    }

    public function cart_resep(){
        return $this->hasMany(CartResep::class);
    }
    public function transactionreseps(){
        return $this->hasMany(TransactionResep::class);
    }
     public function resepproduct()
    {
        return $this->hasMany(ResepProduct::class);
    }

}
