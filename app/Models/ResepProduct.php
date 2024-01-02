<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResepProduct extends Model
{
    use HasFactory;
     protected $fillable = [
        'amount',
        'jenis',
        'product_id',
        'resep_id'
    ];
    public function product()
{
    return $this->belongsTo(Product::class); 
}
    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
    public function order_offline()
    {
        return $this->belongsTo(OrderOffline::class);
    }
}
