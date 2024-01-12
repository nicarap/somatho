<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "slug",
        "published_at",
        "is_pinned",
        "image"
    ];

    protected $casts = ["published_at" => "date"];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query)
    {
        return $query->whereDate("published_at", "<=", Carbon::now());
    }
}
