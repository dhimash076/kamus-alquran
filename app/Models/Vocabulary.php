<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vocabulary extends Model
{
    protected $fillable = ['category_id', 'arabic', 'transliteration', 'meaning', 'video_path'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}