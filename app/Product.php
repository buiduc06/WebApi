<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'id','user_id', 'cate_id', 'name','slug','description','image','status','github','meta','summary','demolink'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category','cate_id','id');
    }

     
    public function getImage()
    {
    	if (!empty($this->image)) {
            return asset('images/' . $this->image);
        }
        return asset('images/default.png');
    }
     // public function getProduct(
     // {
     //     $data =[
     //        'id' =>$this->id,
     //        'cate_id'=>$this->cate_id,
     //        'name'=>$this->name,
     //        'slug'=>$this->slug,
     //        'description'=>$this->description,
     //        'image'=>$this->getImage(),
     //        'status'=>$this->status!=null,
     //        'github'=>$this->github,
     //     ]
     // }


}
