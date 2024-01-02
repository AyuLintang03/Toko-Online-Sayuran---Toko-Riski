<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartResep extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'resep_id',
        'amount'
    ];

    public function resep(){
        return $this->belongsTo(Resep::class);
    }
}
