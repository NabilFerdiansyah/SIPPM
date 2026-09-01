<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Operator\DashboardController as OperatorDashboard;
use App\Http\Controllers\Operator\LaporanController as OperatorLaporan;
use App\Http\Controllers\Operator\ProfilController as OperatorProfil;
use App\Http\Controllers\Supervisor\AkunController;
use App\Http\Controllers\Supervisor\DashboardController as SupervisorDashboard;
use App\Http\Controllers\Supervisor\HistoriController;
use App\Http\Controllers\Supervisor\PenugasanController;
use App\Http\Controllers\Supervisor\ProfilController as SupervisorProfil;
use App\Http\Controllers\Supervisor\ValidasiAkhirController;
use App\Http\Controllers\Supervisor\ValidasiController;
use App\Http\Controllers\Teknisi\DashboardController as TeknisiDashboard;
use App\Http\Controllers\Teknisi\HasilController;
use App\Http\Controllers\Teknisi\ProfilController as TeknisiProfil;
use App\Http\Controllers\Teknisi\TugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SIPPM - PG Rendeng
| Sistem Informasi Pelaporan & Penanganan Kerusakan Mesin Giling
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // ============ OPERATOR ============
    Route::prefix('operator')->name('operator.')->middleware('role:operator')->group(function () {
        Route::get('/dashboard', [OperatorDashboard::class, 'index'])->name('dashboard');
        Route::get('/laporan/buat', [OperatorLaporan::class, 'create'])->name('laporan.create');
        Route::post('/laporan', [OperatorLaporan::class, 'store'])->name('laporan.store');
        Route::get('/laporan', [OperatorLaporan::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [OperatorLaporan::class, 'show'])->name('laporan.show');
        Route::get('/profil', [OperatorProfil::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [OperatorProfil::class, 'update'])->name('profil.update');
    });

    // ============ SUPERVISOR ============
    Route::prefix('supervisor')->name('supervisor.')->middleware('role:supervisor')->group(function () {
        Route::get('/dashboard', [SupervisorDashboard::class, 'index'])->name('dashboard');

        Route::get('/validasi', [ValidasiController::class, 'index'])->name('validasi.index');
        Route::get('/validasi/{laporan}', [ValidasiController::class, 'show'])->name('validasi.show');
        Route::post('/validasi/{laporan}/setujui', [ValidasiController::class, 'validasi'])->name('validasi.setujui');
        Route::post('/validasi/{laporan}/tolak', [ValidasiController::class, 'tolak'])->name('validasi.tolak');

        Route::get('/penugasan', [PenugasanController::class, 'index'])->name('penugasan.index');
        Route::get('/penugasan/{laporan}', [PenugasanController::class, 'create'])->name('penugasan.create');
        Route::post('/penugasan/{laporan}', [PenugasanController::class, 'store'])->name('penugasan.store');

        Route::get('/validasi-akhir', [ValidasiAkhirController::class, 'index'])->name('validasi-akhir.index');
        Route::get('/validasi-akhir/{laporan}', [ValidasiAkhirController::class, 'show'])->name('validasi-akhir.show');
        Route::post('/validasi-akhir/{laporan}/selesai', [ValidasiAkhirController::class, 'selesaikan'])->name('validasi-akhir.selesai');
        Route::post('/validasi-akhir/{laporan}/kembalikan', [ValidasiAkhirController::class, 'kembalikan'])->name('validasi-akhir.kembalikan');

        Route::get('/histori', [HistoriController::class, 'index'])->name('histori.index');

        Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
        Route::get('/akun/tambah', [AkunController::class, 'create'])->name('akun.create');
        Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
        Route::get('/akun/{akunBaru}/berhasil', [AkunController::class, 'berhasil'])->name('akun.berhasil');
        Route::post('/akun/{akun}/toggle-status', [AkunController::class, 'toggleStatus'])->name('akun.toggle-status');

        Route::get('/profil', [SupervisorProfil::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [SupervisorProfil::class, 'update'])->name('profil.update');
    });

    // ============ TEKNISI ============
    Route::prefix('teknisi')->name('teknisi.')->middleware('role:teknisi')->group(function () {
        Route::get('/dashboard', [TeknisiDashboard::class, 'index'])->name('dashboard');
        Route::get('/tugas/{penugasan}', [TugasController::class, 'show'])->name('tugas.show');
        Route::post('/tugas/{penugasan}/mulai', [TugasController::class, 'mulai'])->name('tugas.mulai');
        Route::get('/tugas/{penugasan}/hasil', [HasilController::class, 'create'])->name('tugas.hasil.create');
        Route::post('/tugas/{penugasan}/hasil', [HasilController::class, 'store'])->name('tugas.hasil.store');
        Route::get('/riwayat', [TugasController::class, 'riwayat'])->name('riwayat.index');
        Route::get('/profil', [TeknisiProfil::class, 'edit'])->name('profil.edit');
        Route::put('/profil', [TeknisiProfil::class, 'update'])->name('profil.update');
    });
});
