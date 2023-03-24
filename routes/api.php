<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', 'App\Http\Controllers\Api\ProductController');
Route::get('products/images/{image}', 'App\Http\Controllers\Api\ProductController@showImage');
Route::get('products/search/{name}', 'App\Http\Controllers\Api\ProductController@search');

Route::resource('transactions', 'App\Http\Controllers\Api\TransactionController');
Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');

Route::get('/provinsi', 'App\Http\Controllers\Api\CheckOngkirController@index');
Route::get('/city/{id}', 'App\Http\Controllers\Api\CheckOngkirController@getKota');
Route::get('/ongkir/{destination}/{courier}', 'App\Http\Controllers\Api\CheckOngkirController@getOngkir');
Route::post('/ongkir/{destination}/{courier}', 'App\Http\Controllers\Api\CheckOngkirController@getOngkir');