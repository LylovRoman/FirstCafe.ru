<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'waiter_id');
    }
    public function positions()
    {
        return $this->hasMany(Position::class, 'order_id', 'id');
    }
}
