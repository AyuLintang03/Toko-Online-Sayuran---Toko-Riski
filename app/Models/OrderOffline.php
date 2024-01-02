<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOffline extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'alamat',
        'RTRW',
        'postcode',
        'phone',
        'status',
        'batas_waktu',
        'subtotal',
    ];
    public function transaksiorderofflines()
    {
        return $this->hasMany(TransaksiOrderOffline::class);
    }
    
}
