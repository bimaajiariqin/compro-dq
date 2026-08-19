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
use App\Http\Controllers\Admin\IklanController;
use App\Http\Controllers\Admin\VideoKebaikanController;
use App\Http\Controllers\Admin\ProgramPokokController;
use App\Http\Controllers\Admin\MitraKebaikanController;
use App\Http\Controllers\Admin\HeroSettingController;
use App\Http\Controllers\Admin\HeroStatController;
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

        Route::post('/berita/upload-gambar', [AdminBeritaController::class, 'uploadImage'])
            ->name('berita.upload-gambar');
        Route::resource('berita', AdminBeritaController::class)
            ->parameters(['berita' => 'berita']);

        Route::resource('testimoni', TestimoniController::class);
        Route::resource('penghargaan', PenghargaanController::class);
        Route::resource('laporan-keuangan', LaporanKeuanganController::class)
            ->parameters(['laporan-keuangan' => 'laporan_keuangan']);
        Route::resource('rekening-donasi', RekeningDonasiController::class)
            ->parameters(['rekening-donasi' => 'rekening_donasi']);
        Route::resource('iklan', IklanController::class);
        Route::resource('videokebaikan', VideoKebaikanController::class); // hapus ->names('admin.videokebaikan');
        Route::resource('program-pokok', ProgramPokokController::class)
            ->parameters(['program-pokok' => 'programPokok']);
        Route::resource('mitra', MitraKebaikanController::class)->except(['show']);

        Route::get('/hero-setting', [HeroSettingController::class, 'edit'])->name('hero-setting.edit');
        Route::put('/hero-setting/{heroSetting}', [HeroSettingController::class, 'update'])->name('hero-setting.update');

        Route::resource('hero-stat', HeroStatController::class)
            ->except(['show'])
            ->names('hero-stat');
    });

});