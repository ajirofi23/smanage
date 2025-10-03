<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PanelController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
});

Route::middleware(['auth'])->group(function() {
    Route::get('/panel/manage', [PanelController::class, 'index'])->middleware('userAkses:administrator') ;
    Route::get('/panel/manage/hyari-hatto', [PanelController::class, 'hyariHatto'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('hyari-hatto.index');

    Route::get('/panel/manager', [PanelController::class, 'manager'])->middleware('userAkses:manager');
    Route::get('/panel/supervisor', [PanelController::class, 'supervisor'])->middleware('userAkses:supervisor');
    Route::get('/panel/employee', [PanelController::class, 'employee'])->middleware('userAkses:employee');
    Route::get('/logout', [SessionController::class, 'logout']);
});



