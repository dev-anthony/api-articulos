<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticuloController;

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

Route::get('articulos', [ArticuloController::class, 'index']);
Route::get('articulos/{id}', [ArticuloController::class, 'show']); //Cuando se vaya a la ruta articulos y le pogamos un id, me va a dar los datos del articulo relacionado con el id
Route::post('articulos/', [ArticuloController::class, 'store']);
Route::put('articulos/{id}', [ArticuloController::class, 'update']);
Route::delete('articulos/{id}', [ArticuloController::class, 'destroy']);
