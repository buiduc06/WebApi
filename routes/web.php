<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('admin/home', 'HomeController@index')->name('home');
Route::get('getProduct/{cate_id}', function($cate_id) {
    $getProduct1 = App\Product::where('cate_id',$cate_id)->get();
 return $getProduct1;
     
});

  