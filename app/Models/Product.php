<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'product_name',
        'product_description',
        'category_id',
        'sub_category_id',
        'image',
        'stock',
        'bought_in',
        'price',
        'stock_threshold',
        'status',        
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function sub_category(){
        return $this->belongsTo(SubCategory::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
