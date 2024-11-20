<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','subcategory_id','name','image','price','color','quantity'];

    protected function category(){
        return $this->belongsTo(Category::class);
    }

    protected function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id','id');
    }
}
