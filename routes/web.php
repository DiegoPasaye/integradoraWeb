<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Zona;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

Route::post('/login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/admin', function () {
        return view('admin');
    });
});
Route::get('/admin', function () {
    $zonasId = Auth::user()->zonasId;
    $zonas = Zona::whereIn('id', $zonasId)->get();

    return view('admin', ['zonas' => $zonas]);
})->middleware('auth');

Route::get('/zona/{id}', [UserController::class, 'show'])->name('zona');
Route::post('/admin/zonas/{id}/toggle', [UserController::class, 'toggleZonaStatus'])->name('toggle-zona');


//ADMINISTRACION ----------------------------------------
Route::get('/administracion', function () {
    return view('administracion/admin');
});


Route::get('/administracion/users', [UserController::class, 'showUsers']);
Route::delete('/administracion/users/{id}', [UserController::class, 'destroyUser']);
Route::get('/administracion/users/{id}/edit', [UserController::class, 'editUserFull']);
Route::put('/administracion/users/{id}', [UserController::class, 'updateUser']);
Route::post('/administracion/users', [UserController::class, 'createUser']);



Route::get('/administracion/zonas', [UserController::class, 'showZonas']);
Route::get('/administracion/zonas/{id}/edit', [UserController::class, 'editZona']);
Route::put('/administracion/zonas/{id}', [UserController::class, 'updateZona']);
Route::post('/administracion/zonas', [UserController::class, 'createZona']);
Route::delete('/administracion/zonas/{id}', [UserController::class, 'destroyZona']);
