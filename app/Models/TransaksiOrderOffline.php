<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiOrderOffline extends Model
{
    use HasFactory;
     protected $fillable = [
        'amount',
        'product_id',
        'order_offline_id'
    ];
      public function orderoffline()
    {
        return $this->belongsTo(OrderOffline::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
