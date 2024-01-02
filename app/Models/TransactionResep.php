<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionResep extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'resep_id',
        'amount'
    ];

    public function orderreseps()
    {
        return $this->belongsTo(Order::class);
    }
    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
}
