<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['restaurant_name','slug','address','phone','vat_number','thumb','closure_day'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


