<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StrawHatController;

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


Route::get('/', function(){
    return response()->json([
        'Success' => true
    ]);
});


Route::get('/mugiwaras',[StrawHatController::class,'index']);
Route::get('/mugiwaras/{id}',[StrawHatController::class,'show']);
Route::post('/mugiwaras',[StrawHatController::class,'store']);
Route::delete('/mugiwaras/{id}',[StrawHatController::class,'destroy']);
Route::put('/mugiwaras/{id}',[StrawHatController::class,'update']);