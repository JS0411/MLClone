<?php

use Illuminate\Support\Facades\Route;

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
    return view('home.index');
});

Auth::routes();

Route::get('/messages', 'PurchaseMessageController@show');
Route::post('/messages', 'PurchaseMessageController@store');
Route::get('/classified/search', 'ClassifiedsController@index');
Route::get('/classified/create', 'ClassifiedsController@create');
Route::get('/classified', 'ClassifiedsController@carouselIndex');
Route::post('/classified', 'ClassifiedsController@store');
Route::get('classified/{classified}', 'ClassifiedsController@show');
Route::get('classified/{id}/edit', 'ClassifiedsController@edit');
Route::put('classified/{id}', 'ClassifiedsController@update');
Route::delete('/classified/{id}', 'ClassifiedsController@destroy');
Route::get('/purchase', 'PurchaseController@index')->name('purchase.index');
Route::post('/purchase', 'PurchaseController@store');
Route::get('/purchase/create', 'PurchaseController@create')->name('purchase.create');
Route::get('/purchase/{id}', 'PurchaseController@show')->name('purchase.show');
Route::get('/purchase/{id}/reputation/create', 'ReputationController@create')->name('reputation.create');
Route::post('/reputation', 'ReputationController@store')->name('reputation.store');
Route::get('userinfo/{id}/reputation', 'ReputationController@index')->name('reputation.index');
Route::apiResource('questions', 'QuestionsController');
Route::apiResource('articleinfo', 'ArticleInfoController');
Route::apiResource('/reputations', 'UserReputationController');
Route::get('/userinfo', 'UsersController@index');
Route::post('/image', 'UserImageController@store');
Route::delete('/image', 'UserImageController@destroy');
Route::get('/userinfo/questions','UserQuestionsController@index')->name('userquestions.index');
Route::get('/userinfo/classifieds', 'UserClassifiedsController@index');
Route::post('/favorites/{id}', 'FavoritesController@store');
Route::get('userinfo/favorites', 'FavoritesController@index');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

