<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'guest_name', 'guest_lastname', 'guest_address', 'guest_phone', 'guest_mail', 'total_goods', 'total'
    ];


    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
