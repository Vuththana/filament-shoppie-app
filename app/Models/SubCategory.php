<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category_name',
        'sub_category_description',
        'slug',
        'category_id',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
