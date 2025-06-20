<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 
        'last_name',
        'phone',
        'city',
        'address',
        'notes',
        'status',
        'total_price', 
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    
}
