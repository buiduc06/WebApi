<?php 

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// $c = 'Admin\\DashboardController@';
// // route name
$r = 'admin';

/*
|----------------------------------------------------------------------------------------------------------------------------
|                     URL                     |           CONTROLLER            |               NAME
|----------------------------------------------------------------------------------------------------------------------------
*/    

// Route::get('/',                               $c.'index'                        )->name($r.'.dashboard');


 

// Route::prefix('product')->group(function(){
//     // controller
//     $c = 'Admin\\ProductController@';
//     // route name
//     $r = 'admin.product';
    /*
    |----------------------------------------------------------------------------------------------------------------------------
    |                     URL                     |           CONTROLLER            |               NAME
    |----------------------------------------------------------------------------------------------------------------------------
    */    
//     Route::resource('ProductController');



// });
Route::get('/', 'Admin\\AdminController@index')->name('admin.index');
Route::resource('product', 'Admin\ProductController');

Route::resource('category', 'Admin\\CategoryController');

Route::get('setting', 'Admin\\AdminController@setting')->name('admin.setting');
Route::get('listapp', 'Admin\\AdminController@listApp')->name('admin.listapp');

 


 ?>