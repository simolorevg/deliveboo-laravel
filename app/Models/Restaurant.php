<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['restaurant_name', 'user_id', 'slug', 'address', 'phone', 'vat_number', 'thumb', 'closure_day'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function dishes(){
        return $this->hasMany(Dish::class);
    }
}
