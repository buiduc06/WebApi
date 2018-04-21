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
    	return $this->hasMany('App\Product','id','cate_id');
    }
    public function getTotalProduct()
    {
    	return Product::where('cate_id', $this->id)->count();
    }
}
