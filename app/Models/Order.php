<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'order_number',
        'order_date',
        'status',
        'payment_method',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
