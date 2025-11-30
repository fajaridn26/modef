<?php

use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ProjectDetailController;
use App\Http\Controllers\API\UserController;
// use App\Livewire\Userlist;
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

Route::apiResource('/users', UserController::class);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/search', [ProjectController::class, 'search']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
// Route::apiResource('/projects', ProjectController::class);
// Route::apiResource('/projects/search', ProjectController::class);
// Route::apiResource('/projects/{$id}', ProjectController::class);

