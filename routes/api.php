<?php

use App\Http\Controllers\AccountController;
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

Route::get('/account/get/{username}', [AccountController::class, 'show']);
Route::post('/account/register', [AccountController::class, 'save']);
Route::post('/account/auth', [AccountController::class, 'auth']);
Route::put('/account/update', [AccountController::class, 'update']);
Route::delete('/account/delete', [AccountController::class, 'delete']);
