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

//Backpack routes
Route::group(['prefix' => config('backpack.base.route_prefix', 'admin'), 'middleware' => ['web', 'auth']], function () {
    CRUD::resource('store', 'Admin\StoreCrudController');
    CRUD::resource('article', 'Admin\ArticleCrudController');
});

Route::group(['prefix' => 'services', 'middleware' => 'App\Http\Middleware\BasicAuthJsonMiddleware'], function(){
    Route::get('stores',"StoreController@index");
    Route::get('articles',"ArticleController@index");
    Route::get('stores/{id}/articles',"StoreController@article_by_store");
    Route::post('stores',"StoreController@index_xml");
    Route::post('articles',"ArticleController@index_xml");
    Route::post('stores/{id}/articles',"StoreController@article_by_store");
});




