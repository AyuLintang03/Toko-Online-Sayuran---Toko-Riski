<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'alamat',
        'kecamatan',
        'RTRW',
        'postcode',
        'phone',
        'status',
        'batas_waktu',
        'subtotal',
        'payment_receipt'
    ];
    protected $dates = [];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function transactionreseps() 
    {
        return $this->hasMany(TransactionResep::class);
    }
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

       public function Notification()
    {
        return $this->hasOne(Notification::class);
    }

}
