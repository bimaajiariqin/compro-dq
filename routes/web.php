<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\PenghargaanController;
use App\Http\Controllers\Admin\LaporanKeuanganController;
use App\Http\Controllers\Admin\RekeningDonasiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman publik (company profile)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/rekening-donasi', [RekeningController::class, 'index'])->name('rekening.index');
Route::get('/tentang-kami', [TentangKamiController::class, 'index'])->name('tentang-kami');
Route::prefix('program')->name('program.')->group(function () {
    Route::get('/pendidikan', [ProgramController::class, 'pendidikan'])->name('pendidikan');
    Route::get('/ekonomi', [ProgramController::class, 'ekonomi'])->name('ekonomi');
    Route::get('/dakwah', [ProgramController::class, 'dakwah'])->name('dakwah');
    Route::get('/kemanusiaan', [ProgramController::class, 'kemanusiaan'])->name('kemanusiaan');
});

/*
|--------------------------------------------------------------------------
| Panel admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('berita', AdminBeritaController::class)
            ->parameters(['berita' => 'berita']);
        Route::resource('testimoni', TestimoniController::class);
        Route::resource('penghargaan', PenghargaanController::class);
        Route::resource('laporan-keuangan', LaporanKeuanganController::class)
            ->parameters(['laporan-keuangan' => 'laporan_keuangan']);
        Route::resource('rekening-donasi', RekeningDonasiController::class)
            ->parameters(['rekening-donasi' => 'rekening_donasi']);

    });

});