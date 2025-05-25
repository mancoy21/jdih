<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'file_path',
        'caption',
        'order'
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
