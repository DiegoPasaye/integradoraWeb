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





