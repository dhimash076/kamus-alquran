<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'vocabulary_id' => $id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas masukan Anda!');
    }
}
