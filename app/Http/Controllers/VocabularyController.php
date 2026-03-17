<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
use App\Models\Category;
use Illuminate\Http\Request;

class VocabularyController extends Controller
{
    /**
     * Menampilkan daftar kosa kata di halaman depan (Home).
     * Secara otomatis menampilkan data terbaru jika tidak ada pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Mengambil semua kategori untuk ditampilkan di navigasi atau filter
        $categories = Category::all();

        // Logika: Jika ada input search, cari berdasarkan Arab, Arti, atau Transliterasi.
        // Jika kosong, tampilkan semua kosa kata dari yang terbaru.
        $results = Vocabulary::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('arabic', 'like', "%{$search}%")
                             ->orWhere('meaning', 'like', "%{$search}%")
                             ->orWhere('transliteration', 'like', "%{$search}%");
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(12);

        return view('welcome', compact('results', 'categories'));
    }

    /**
     * Menampilkan halaman detail kosa kata tunggal.
     * Digunakan untuk melihat video bahasa isyarat secara penuh.
     */
    public function show($id)
    {
        // Mencari kosa kata beserta kategorinya, jika tidak ketemu akan muncul error 404
        $vocabulary = Vocabulary::with('category')->findOrFail($id);
        
        return view('detail', compact('vocabulary'));
    }
}