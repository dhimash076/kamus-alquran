<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VocabularyAdminController extends Controller 
{
    public function index() {
        $vocabularies = Vocabulary::latest()->get();
        $feedbacks = Feedback::with(['user', 'vocabulary'])->latest()->get();
        return view('admin.index', compact('vocabularies', 'feedbacks'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
    // 1. Validasi yang lebih ketat
    $request->validate([
        'arabic' => 'required',
        'transliteration' => 'required',
        'meaning' => 'required',
        'video' => 'nullable|mimes:mp4,mov|max:50000',
    ]);

    try {
        $data = $request->only(['arabic', 'transliteration', 'meaning']);

        if ($request->hasFile('video')) {
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        Vocabulary::create($data);
        return redirect()->route('admin.index')->with('success', 'Data masuk!');
    } catch (\Exception $e) {
        // Jika gagal karena database, ini akan memunculkan pesannya
        return back()->withErrors(['db_error' => 'Gagal Simpan: ' . $e->getMessage()])->withInput();
    }
}

    public function edit($id) {
        $vocabulary = Vocabulary::findOrFail($id);
        return view('admin.edit', compact('vocabulary'));
    }

    public function update(Request $request, $id) {
        $item = Vocabulary::findOrFail($id);
        $request->validate([
            'arabic' => 'required',
            'video' => 'nullable|mimes:mp4,mov|max:20000',
        ]);

        $data = $request->only(['arabic', 'transliteration', 'meaning']);
        if ($request->hasFile('video')) {
            if ($item->video_path) Storage::disk('public')->delete($item->video_path);
            $data['video_path'] = $request->file('video')->store('videos', 'public');
        }

        $item->update($data);
        return redirect()->route('admin.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id) {
        $item = Vocabulary::findOrFail($id);
        if ($item->video_path) Storage::disk('public')->delete($item->video_path);
        $item->delete();
        return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus!');
    }
}