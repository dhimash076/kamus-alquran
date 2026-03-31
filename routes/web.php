<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\VocabularyAdminController;

// --- JALUR DARURAT UNTUK HOSTING (HAPUS JIKA SUDAH BERHASIL) ---
Route::get('/buat-symlink', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    // Jika symlink sudah ada
    if (file_exists($link)) {
        return 'SYMLINK SUDAH ADA. Tidak perlu dibuat ulang.';
    }

    try {
        // Coba buat symlink dengan PHP native (tanpa exec)
        symlink($target, $link);
        return 'SUKSES: Symlink berhasil dibuat! ' . $link . ' → ' . $target;
    } catch (\Exception $e) {
        // Jika symlink gagal, salin file secara manual sebagai alternatif
        return 'GAGAL membuat symlink: ' . $e->getMessage() . 
               '<br><br><strong>SOLUSI MANUAL:</strong> Upload isi folder <code>storage/app/public/</code> ke folder <code>public/storage/</code> di hosting via File Manager.';
    }
});
// -------------------------------------------------------------

// --- 1. AKSES PUBLIK ---
Route::get('/', [VocabularyController::class, 'index'])->name('homepage');
Route::get('/vocabulary/{id}', [VocabularyController::class, 'show'])->name('vocabulary.detail');

// --- 2. AKSES WAJIB LOGIN ---
Route::middleware(['auth'])->group(function () {

    // Logika Redirect Dashboard berdasarkan Role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.index');
        }
        return redirect('/');
    })->name('dashboard');

    // Fitur Feedback
    Route::post('/vocabulary/{id}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // --- 3. AKSES KHUSUS ADMIN ---
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [VocabularyAdminController::class, 'index'])->name('index');
        Route::get('/create', [VocabularyAdminController::class, 'create'])->name('create');
        Route::post('/store', [VocabularyAdminController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [VocabularyAdminController::class, 'edit'])->name('edit');
        Route::put('/{id}', [VocabularyAdminController::class, 'update'])->name('update');
        Route::delete('/{id}', [VocabularyAdminController::class, 'destroy'])->name('destroy');
    });
});

// --- 4. PANGGIL AUTH (HANYA SEKALI DI SINI) ---
require __DIR__ . '/auth.php';