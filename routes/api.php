<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PanduanController;
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

// Route Account
Route::get('/account/get/{username}', [AccountController::class, 'show']);
Route::get('/account/get/id/{id}', [AccountController::class, 'show_by_id']);
Route::post('/account/register', [AccountController::class, 'save']);
Route::post('/account/auth', [AccountController::class, 'auth']);
Route::put('/account/update', [AccountController::class, 'update']);
Route::delete('/account/delete', [AccountController::class, 'delete']);

// Route Panduan
Route::get('/panduan/get', [PanduanController::class, 'show']);

// Route Event
Route::get('/event/get', [EventController::class, 'show']);