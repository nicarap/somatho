<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "article_id",
        "commenter",
        "content",
    ];

    public function articles(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
