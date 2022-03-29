<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/add/product', [ProductController::class,"addProduct"]);
Route::get('/get/products', [ProductController::class,"getProducts"]);

Route::post('/signup', [ClientController::class,"Signup"]);
Route::post('/buy/product', [ClientController::class,"BuyProduct"]);

Route::get('/get/user/{id}', [ClientController::class,"getUser"]);
Route::get('/get/user', [ClientController::class,"getUsers"]);

Route::get('/currensi', [CurrencyController::class,"getCurrency"]);



