<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'login']);
});

Route::middleware(['auth'])->group(function() {
 Route::get('/panel/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/panel/manage', [PanelController::class, 'index'])->middleware('userAkses:administrator') ;
    Route::get('/panel/manage/hyari-hatto', [PanelController::class, 'hyariHatto'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('hyari-hatto.index');
    Route::get('/panel/manage/laporinsiden', [PanelController::class, 'laporInsiden'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('laporinsiden.index');
    Route::get('/panel/manage/laporaccident', [PanelController::class, 'laporAccident'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('laporaccident.index');
    Route::get('/panel/manage/komitmenk3', [PanelController::class, 'komitmenK3'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('komitmenk3.index');
    Route::get('/panel/manage/safetypatrol', [PanelController::class, 'safetyPatrol'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('safetypatrol.index');
    Route::get('/panel/manage/safetyriding', [PanelController::class, 'safetyRiding'])
    ->middleware(['auth', 'userAkses:administrator'])
    ->name('safetyriding.index');

// Perilaku Tidak Aman
Route::middleware(['auth', 'userAkses:administrator'])
    ->prefix('panel/manage/perilakutidakaman')
    ->group(function () {
        Route::get('/', [PanelController::class, 'perilakuTidakAman'])->name('perilakutidakaman.index');
        Route::get('/data', [PanelController::class, 'getPerilakuTidakAman']);
        Route::post('/store', [PanelController::class, 'storePerilakuTidakAman']);
        Route::get('/show/{id}', [PanelController::class, 'showPerilakuTidakAman']);
        Route::delete('/delete/{id}', [PanelController::class, 'deletePerilakuTidakAman']);
    });

// Kondisi Tidak Aman
Route::middleware(['auth', 'userAkses:administrator'])
    ->prefix('panel/manage/kondisitidakaman')
    ->group(function () {
        Route::get('/', [PanelController::class, 'kondisiTidakAman'])->name('kondisitidakaman.index');
        Route::get('/data', [PanelController::class, 'dataKondisiTidakAman']);
        Route::post('/store', [PanelController::class, 'storeKondisiTidakAman']);
        Route::get('/show/{id}', [PanelController::class, 'showKondisiTidakAman']);
        Route::delete('/delete/{id}', [PanelController::class, 'deleteKondisiTidakAman']);
    });

// Potensi Bahaya
Route::middleware(['auth', 'userAkses:administrator'])
    ->prefix('panel/manage/potensibahaya')
    ->group(function () {
        Route::get('/', [PanelController::class, 'potensiBahaya'])->name('potensibahaya.index');
        Route::get('/data', [PanelController::class, 'dataPotensiBahaya']);
        Route::post('/store', [PanelController::class, 'storePotensiBahaya']);
        Route::get('/show/{id}', [PanelController::class, 'showPotensiBahaya']);
        Route::delete('/delete/{id}', [PanelController::class, 'deletePotensiBahaya']);
    });

// === Add User ===
Route::middleware(['auth', 'userAkses:administrator'])
    ->prefix('panel/manage/add-user')
    ->group(function () {
        Route::get('/', [PanelController::class, 'addUser'])->name('add-user.index');
        Route::get('/data', [PanelController::class, 'getUsers']);
        Route::post('/', [PanelController::class, 'storeUser']);
        Route::put('/{id}', [PanelController::class, 'updateUser']);
        Route::delete('/{id}', [PanelController::class, 'deleteUser']);
    });


    Route::get('/panel/manager', [PanelController::class, 'manager'])->middleware('userAkses:manager');
    Route::get('/panel/supervisor', [PanelController::class, 'supervisor'])->middleware('userAkses:supervisor');
    Route::get('/panel/employee', [PanelController::class, 'employee'])->middleware('userAkses:employee');
    Route::get('/logout', [SessionController::class, 'logout']);
});
