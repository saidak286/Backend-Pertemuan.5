<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
# import Animal Controller
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\StudentController;

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

# method get, endpoint animals
Route::get('/animals', [AnimalController::class, 'index']);

# method post, endpoint animals
Route::post('/animals', [AnimalController::class, 'store']);

# method put,
Route::put('/animals/(id)', [AnimalController::class, 'update']);

# method delete
Route::delete('/animals/(id)', [AnimalController::class, 'destroy']);

# Routing untuk student
Route::get("/student", [StudentController::class, 'index']);