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

//this was removed form here to include on the respective specification
Route::group(['prefix' => 'services', 'middleware' => 'App\Http\Middleware\BasicAuthMiddleware'], function(){
    Route::get('stores',"StoreController@index_xml");
    Route::get('articles',"ArticleController@index_xml");
    Route::get('stores/{id}/articles',"StoreController@article_by_store");
});

