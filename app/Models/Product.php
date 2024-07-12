<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'description',
        'category_id',
        'product_name',
        'image',
        'bought_in',
        'price',
        'quantity_sold',
        'stock_threshold',
        'status',        
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function sub_category(){
        return $this->belongsTo(Category::class);
    }
}
