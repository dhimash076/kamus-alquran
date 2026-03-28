<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vocabulary extends Model
{
    protected $fillable = ['arabic', 'transliteration', 'meaning', 'video_path'];
}