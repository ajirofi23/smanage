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
    // Profile - Semua role bisa akses
    Route::get('/panel/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Dashboard - Semua role bisa akses
   // Dashboard utama (khusus role tertentu)
Route::get('/panel/manage', [PanelController::class, 'index'])
    ->middleware(['userAkses:administrator,supervisor,manager'])
    ->name('dashboard');


    // === MANAGEMEN INSIDENT - Supervisor ===
    Route::prefix('/panel/manage')->middleware(['userAkses:supervisor'])->group(function () {
        Route::get('/hyari-hatto', [PanelController::class, 'hyariHatto'])->name('hyari-hatto.index');
        Route::get('/laporinsiden', [PanelController::class, 'laporInsiden'])->name('laporinsiden.index');
        Route::get('/laporaccident', [PanelController::class, 'laporAccident'])->name('laporaccident.index');
    });

    // === MANAGEMEN AUDIT - Supervisor ===
    Route::prefix('/panel/manage')->middleware(['userAkses:supervisor'])->group(function () {
        Route::get('/safetypatrol', [PanelController::class, 'safetyPatrol'])->name('safetypatrol.index');
        Route::get('/safetyriding', [PanelController::class, 'safetyRiding'])->name('safetyriding.index');
    });

    // === KOMITMEN K3 -  Supervisor & Employee ===
    Route::get('/panel/manage/komitmenk3', [PanelController::class, 'komitmenK3'])
        ->middleware(['userAkses:supervisor,employee'])
        ->name('komitmenk3.index');

    // === DATA MASTER - Supervisor ===
    
    // Perilaku Tidak Aman
    Route::middleware(['userAkses:supervisor'])
        ->prefix('panel/manage/perilakutidakaman')
        ->group(function () {
            Route::get('/', [PanelController::class, 'perilakuTidakAman'])->name('perilakutidakaman.index');
            Route::get('/data', [PanelController::class, 'getPerilakuTidakAman']);
            Route::post('/store', [PanelController::class, 'storePerilakuTidakAman']);
            Route::get('/show/{id}', [PanelController::class, 'showPerilakuTidakAman']);
            Route::delete('/delete/{id}', [PanelController::class, 'deletePerilakuTidakAman']);
        });

    // Kondisi Tidak Aman
    Route::middleware(['userAkses:supervisor'])
        ->prefix('panel/manage/kondisitidakaman')
        ->group(function () {
            Route::get('/', [PanelController::class, 'kondisiTidakAman'])->name('kondisitidakaman.index');
            Route::get('/data', [PanelController::class, 'dataKondisiTidakAman']);
            Route::post('/store', [PanelController::class, 'storeKondisiTidakAman']);
            Route::get('/show/{id}', [PanelController::class, 'showKondisiTidakAman']);
            Route::delete('/delete/{id}', [PanelController::class, 'deleteKondisiTidakAman']);
        });

    // Potensi Bahaya
    Route::middleware(['userAkses:supervisor'])
        ->prefix('panel/manage/potensibahaya')
        ->group(function () {
            Route::get('/', [PanelController::class, 'potensiBahaya'])->name('potensibahaya.index');
            Route::get('/data', [PanelController::class, 'dataPotensiBahaya']);
            Route::post('/store', [PanelController::class, 'storePotensiBahaya']);
            Route::get('/show/{id}', [PanelController::class, 'showPotensiBahaya']);
            Route::delete('/delete/{id}', [PanelController::class, 'deletePotensiBahaya']);
        });

    // === MANAGEMENT USER - Hanya Administrator ===
    Route::middleware(['userAkses:administrator'])
        ->prefix('panel/manage/add-user')
        ->group(function () {
            Route::get('/', [PanelController::class, 'addUser'])->name('add-user.index');
            Route::get('/data', [PanelController::class, 'getUsers']);
            Route::post('/', [PanelController::class, 'storeUser']);
            Route::put('/{id}', [PanelController::class, 'updateUser']);
            Route::delete('/{id}', [PanelController::class, 'deleteUser']);
        });

    // === ROLE SPECIFIC DASHBOARDS (jika masih diperlukan) ===
    Route::get('/panel/manager', [PanelController::class, 'manager'])->middleware('userAkses:manager')->name('manager.dashboard');
    Route::get('/panel/supervisor', [PanelController::class, 'supervisor'])->middleware('userAkses:supervisor')->name('supervisor.dashboard');
    Route::get('/panel/employee', [PanelController::class, 'employee'])->middleware('userAkses:employee')->name('employee.dashboard');

    // Logout
    Route::get('/logout', [SessionController::class, 'logout'])->name('logout');
});