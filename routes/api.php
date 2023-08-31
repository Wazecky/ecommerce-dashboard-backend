<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;


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

// Public routes that don't require authentication

// Register a new user
Route::post('register',[UserController::class,'register']);
// User login
Route::post('login',[UserController::class,'login']);
// Add a new product
Route::post('addproduct',[ProductController::class,'addProduct']);
// List all products
Route::get('list',[ProductController::class,'list']);
// Delete a product by ID
Route::delete('delete/{id}',[ProductController::class,'delete']);
// Get product details by ID
Route::get('product/{id}',[ProductController::class,'getProduct']);
// Search for products based on a key
Route::get('search/{key}',[ProductController::class,'search']);
// Update a product by ID
Route::put('update/{id}', [ProductController::class, 'updateProduct']);