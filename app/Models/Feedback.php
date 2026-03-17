<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    // Tambahkan baris ini agar Laravel tidak "menebak-nebak" lagi
    protected $table = 'feedbacks'; 

    protected $fillable = ['user_id', 'vocabulary_id', 'comment'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vocabulary() {
        return $this->belongsTo(Vocabulary::class);
    }
}