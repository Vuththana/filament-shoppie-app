<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Status;
use App\Models\Product;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'order_number',
        'order_date',
        'product_id',
        'total_amount',
        'status',
        'payment_method',
    ];

    protected $cast = [
        'status' => Status::class
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
