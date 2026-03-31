<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\VocabularyAdminController;

// --- JALUR DARURAT UNTUK HOSTING (HAPUS JIKA SUDAH BERHASIL) ---
Route::get('/buat-symlink', function () {
    $source = storage_path('app/public');
    $destination = public_path('storage');

    // Fungsi rekursif untuk menyalin folder
    function copyDirectory($src, $dst) {
        $count = 0;
        if (!is_dir($dst)) {
            mkdir($dst, 0755, true);
        }
        $dir = opendir($src);
        while (($file = readdir($dir)) !== false) {
            if ($file === '.' || $file === '..') continue;
            $srcPath = $src . '/' . $file;
            $dstPath = $dst . '/' . $file;
            if (is_dir($srcPath)) {
                $count += copyDirectory($srcPath, $dstPath);
            } else {
                copy($srcPath, $dstPath);
                $count++;
            }
        }
        closedir($dir);
        return $count;
    }

    try {
        if (!is_dir($source)) {
            return 'GAGAL: Folder storage/app/public tidak ditemukan.';
        }
        $count = copyDirectory($source, $destination);
        return "SUKSES: $count file berhasil disalin dari storage/app/public/ ke public/storage/";
    } catch (\Exception $e) {
        return 'GAGAL: ' . $e->getMessage();
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