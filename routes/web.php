<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    JadwalController,
    KursiController,
    PemesananController as AdminPemesananController,
    PembayaranController as AdminPembayaranController,
    SuratJalanController as AdminSuratJalanController,
    LaporanController
};
use App\Http\Controllers\Checker\{
    DashboardController as CheckerDashboardController,
    CheckInController as CheckerCheckInController,
    SuratJalanController as CheckerSuratJalanController
};
use App\Http\Controllers\Customer\{
    DashboardController as CustomerDashboardController,
    PemesananController as CustomerPemesananController,
    PembayaranController as CustomerPembayaranController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama (welcome)
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard sesuai role
Route::get('/dashboard', function () {
    $user = User::findOrFail(Auth::id());

    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'checker':
            return redirect()->route('checker.dashboard');
        case 'customer':
            return redirect()->route('customer.dashboard');
        default:
            abort(403, 'Akses ditolak.');
    }
})->middleware(['auth', 'verified'])->name('dashboard');


// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/jadwal', JadwalController::class);
        Route::resource('/kursi', KursiController::class);
        Route::resource('/pemesanan', AdminPemesananController::class);
        Route::resource('/pembayaran', AdminPembayaranController::class);
        Route::resource('/surat-jalan', AdminSuratJalanController::class);

        Route::patch('/pemesanan/konfirmasi/{id}', [AdminPemesananController::class, 'konfirmasi'])
        ->name('pemesanan.konfirmasi');

        Route::get('/surat-jalan', [AdminSuratJalanController::class, 'index'])->name('surat-jalan.index');
        Route::get('/surat-jalan/{id}', [AdminSuratJalanController::class, 'show'])->name('surat-jalan.show');
        Route::get('/surat-jalan/{id}/cetak', [AdminSuratJalanController::class, 'cetak'])->name('surat-jalan.cetak');
        Route::get('admin/surat-jalan/{id}/cetak', [AdminSuratJalanController::class, 'cetak'])
        ->name('admin.surat-jalan.cetak');

        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
        Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.show');
    });


// =====================
// CHECKER ROUTES
// =====================
Route::middleware(['auth', 'role:checker'])
    ->prefix('checker')
    ->name('checker.')
    ->group(function () {
        Route::get('/dashboard', [CheckerDashboardController::class, 'index'])->name('dashboard');

        Route::resource('/surat-jalan', CheckerSuratJalanController::class); // admin/surat-jalan
        Route::post('pemesanan/{id}/checkin', [CheckerCheckInController::class, 'checkIn'])->name('checkin');
    });


// =====================
// CUSTOMER ROUTES
// =====================
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

        // Pemesanan
        Route::get('/pemesanan/cetak/{id}', [CustomerPemesananController::class, 'cetak'])->name('pemesanan.cetak');
        Route::resource('/pemesanan', CustomerPemesananController::class);
        Route::get('/kursi/{jadwal}', [CustomerPemesananController::class, 'getKursiByJadwal'])
        ->name('customer.kursi.byJadwal');

        // Pembayaran
        Route::get('/pembayaran', [CustomerPembayaranController::class, 'index'])
            ->name('pembayaran.index');

        Route::get('/pembayaran/create/{pemesanan}', [CustomerPembayaranController::class, 'create'])
            ->name('pembayaran.create');

        Route::post('/pembayaran/store', [CustomerPembayaranController::class, 'store'])
            ->name('pembayaran.store');

        // Profil
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });


// =====================
// Auth Routes Laravel Breeze
// =====================
require __DIR__.'/auth.php';
