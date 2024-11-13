<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\PaymentController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/upload",[ProductController::class, 'upload']);
Route::get("/products",[ProductController::class, "getProducts"]);
Route::get("/products/{style}",[ProductController::class, "getProduct"]);
Route::get("/product/{category}",[ProductController::class, "getCategory"]);
Route::get("/producted/{category}/{brand}/{name}",[ProductController::class, "getDetail"]);
Route::get("/shopFilter",[ProductController::class, "filterProducted"]);
Route::get("/shop",[ProductController::class, "shop"]);

Route::get("/rate",[RateController::class, 'fetchRates']);
Route::get("/region/{id}",[RateController::class, 'fetchRegion']);
Route::post("/createrate",[RateController::class, 'createRates']);

Route::post("/create-gcash-source/{amount}", [PaymentController::class, 'createPaymentLink']);




Route::options('{any}', function () {
    return response()->json(['message' => 'OK']);
})->where('any', '.*');


