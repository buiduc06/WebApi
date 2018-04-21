<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('data', function() {
//     $getCategory = App\Category::all();
//     return response()->json(compact('getCategory'));
// });
// Route::get('getProduct/{cate_id}', function($cate_id) {
//     $getProduct1 = App\Product::where('cate_id',$cate_id)->get();
//  return $getProduct1;
     
// });



Route::group(['middleware' => 'cors'], function()
{
	//route chi lay index va show
   Route::apiResource('/products', 'ProductController',['only' => ['index','show']]);
   Route::apiResource('/categories', 'CategoryController',['only' => ['index','show']]);
});