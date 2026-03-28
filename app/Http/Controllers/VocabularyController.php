<?php

namespace App\Http\Controllers;

use App\Models\Vocabulary;
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

        $results = Vocabulary::when($search, function ($query, $search) {
                return $query->where('arabic', 'like', "%{$search}%")
                             ->orWhere('meaning', 'like', "%{$search}%")
                             ->orWhere('transliteration', 'like', "%{$search}%");
            }, function ($query) {
                return $query->latest();
            })
            ->paginate(12);

        return view('welcome', compact('results'));
    }

    /**
     * Menampilkan halaman detail kosa kata tunggal.
     * Digunakan untuk melihat video bahasa isyarat secara penuh.
     */
    public function show($id)
    {
        // Mencari kosa kata beserta kategorinya, jika tidak ketemu akan muncul error 404
        $vocabulary = Vocabulary::findOrFail($id);
        
        return view('detail', compact('vocabulary'));
    }
}