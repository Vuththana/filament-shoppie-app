<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'category_description',
        'slug',
        'status',
    ];
    
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
}
