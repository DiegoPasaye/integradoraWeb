<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
la url de api.php lleva un localhost/api  /lo que quieras
*/
Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UserController::class, 'apiLogin']);

Route::middleware('auth:api')->post('logout', [UserController::class, 'apiLogout']);

Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API']);
});
Route::get('zonas', [UserController::class, 'getZonas']);
Route::get('accesos', [UserController::class, 'getAccesos']);
