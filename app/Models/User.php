<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\VerifyEmailReminder;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $fillable = [
        'username',
        'image',
        'email',
        'email_verified_at',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      protected $attributes = [
        'password' => null,
    ];

    // public function sendEmailVerificationNotification()
    //{
      //  $this->notify(new Notifications\VerifyEmailReminder());
    //}

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function cart_product(){
        return $this->hasMany(CartProduct::class);
    }

     public function cart_resep(){
        return $this->hasMany(CartResep::class);
    }

    public function Notification(){
        return $this->hasOne(Notifikasi::class);
    }
}
