<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
	protected $table = "product_categories";
	protected $primaryKey = "product_id";
	public $timestamps = false;
	protected $fillable = [
		'product_id','category_id'
	];
}
