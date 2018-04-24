<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $fillable = [
        'id','name','slug'
    ];

    public function product()
    {
    	return $this->belongsToMany('App\Product','product_categories');
    }
    public function getTotalProduct()
    {
    	return ProductCategory::where('category_id', $this->id)->count();
    }
}
