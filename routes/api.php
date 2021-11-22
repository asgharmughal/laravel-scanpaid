<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ChallanController;

Route::post('login', [ApiController::class, 'authenticate']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', [ApiController::class, 'logout']);
    Route::get('get_user', [ApiController::class, 'get_user']);
    Route::get('challans', [ChallanController::class, 'index']);
    Route::get('challans/{id}', [ChallanController::class, 'show']);
    Route::post('create', [ChallanController::class, 'store']);
    Route::put('update/{challan}',  [ChallanController::class, 'update']);
    Route::delete('delete/{challan}',  [ChallanController::class, 'destroy']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
