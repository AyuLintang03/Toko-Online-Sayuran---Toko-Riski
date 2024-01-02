<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryResep extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'name_category_resep',
        'image_category_resep'
    ];

    public function reseps(){
        return $this->hasMany(Resep::class);
    }
}
