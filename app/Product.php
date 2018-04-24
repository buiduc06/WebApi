<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 protected $fillable = [
    'id','user_id', 'name','slug','description','image','status','github','meta','summary','demolink'
];

public function user()
{
 return $this->belongsTo('App\User');
}

public function category()
{
 return $this->belongsToMany('App\Category','product_categories');
}


public function getImage()
{
 if (!empty($this->image)) {
    return asset('images/' . $this->image);
}
return asset('images/default.png');
}

public function getAppAll()
{
   return $data = [
        '1' => 'Trang MyCV',
        '2' => 'App Di Động',
        '3' => 'App Xem Phim',
    ];

}

public function getAppName()
{
    foreach ($this->getAppAll() as $key => $value) {
        switch ($this->status) {
            case $key:
            $data = "$value";
            break;
        }
    }
    $datashow = !empty($data) ? $data :'chưa phân loại';
    return $datashow;
}






}
