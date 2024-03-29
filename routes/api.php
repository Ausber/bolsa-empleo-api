<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OfertaControlloer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login',[AuthController::class,'authenticate']);
Route::post('register',[AuthController::class,'register']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user',[AuthController::class,'getAuthenticatedUser']);
    Route::post('registeroferta',[OfertaControlloer::class,'registerOferta']);
    Route::get('listofertas',[OfertaControlloer::class,'listofertas']);

});

// Route::post('user',[AuthController::class,'user']);
