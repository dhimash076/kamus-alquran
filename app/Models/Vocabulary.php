<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vocabulary extends Model
{
    // Agar bisa mengisi data lewat Seeder/Form
    protected $fillable = ['arabic', 'transliteration', 'meaning', 'video_path', 'category_id'];

    /**
     * Relasi ke model Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}