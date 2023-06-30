<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = ['dish_name', 'restaurant_id', 'slug', 'descritpion', 'ingredients', 'price', 'is_available', 'img'];
   

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
