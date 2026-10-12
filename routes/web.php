<?php

use App\Http\Controllers\CommodityAcquisitionController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\CommodityLocationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Barang
    Route::resource('barang', CommodityController::class)->except('create', 'edit', 'show')->parameter('barang', 'commodity');
    Route::prefix('barang')->name('barang.')->group(function () {
        Route::post('/print', [CommodityController::class, 'generatePDF'])->name('print');
        Route::post('/print/{id}', [CommodityController::class, 'generatePDFIndividually'])->name('print-individual');
        Route::post('/export', [CommodityController::class, 'export'])->name('export');
        Route::post('/import', [CommodityController::class, 'import'])->name('import');
    });

    // Surat
    Route::prefix('surat')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('surat.index');
        Route::post('/store', [SuratController::class, 'store'])->name('surat.store');
        Route::put('/{id}', [SuratController::class, 'update'])->name('surat.update');
        Route::get('/api/surat/{id}', [SuratController::class, 'showApi'])->name('api.surat.show');
        Route::post('/export', [SuratController::class, 'export'])->name('surat.export');
        Route::post('/import', [SuratController::class, 'importExcel'])->name('surat.import');
    });

        // TASK ROUTES
    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::post('/upload', [TaskController::class, 'upload'])->name('upload');
    
        // Export dan Print PDF
        Route::get('/export-pdf', [TaskController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/print', [TaskController::class, 'print'])->name('print');
    });

    // Perolehan
    Route::resource('perolehan', CommodityAcquisitionController::class)
        ->except('create', 'edit', 'show')
        ->parameter('perolehan', 'commodity_acquisition');

    // Ruangan
    Route::resource('ruangan', CommodityLocationController::class)
        ->except('create', 'edit', 'show')
        ->parameter('ruangan', 'commodity_location');
    Route::post('/ruangan/import', [CommodityLocationController::class, 'import'])->name('ruangan.import');
    Route::post('/ruangan/export', [CommodityLocationController::class, 'export'])->name('ruangan.export');

    // Pengguna
    Route::resource('pengguna', UserController::class)
        ->except('create', 'edit', 'show')
        ->parameter('pengguna', 'user');

    // Role & Hak Akses
    Route::resource('peran-dan-hak-akses', RoleController::class)
        ->parameter('peran-dan-hak-akses', 'role');

    // QR Code Verification
    Route::get('/verify/qrcode/{encrypted_id}', [VerificationController::class, 'show'])->name('verify.qrcode');
});
