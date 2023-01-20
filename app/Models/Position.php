<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    public function dish()
    {
        return $this->hasOne(Dish::class, 'id', 'dish_id');
    }
}
