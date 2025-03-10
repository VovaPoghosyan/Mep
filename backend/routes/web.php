<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Test route
Route::get('/test', function () {
    return 'Web route is working!';
});

// Test route for API
Route::get('/api-test', function () {
    return response()->json(['message' => 'API test from web routes is working!']);
});
