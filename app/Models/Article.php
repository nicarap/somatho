<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "slug",
        "published_at",
        "image_thumbnail_url",
        "is_pinned",
        "image"
    ];

    protected $casts = ["published_at" => "date"];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, "articles_has_tags");
    }

    public function scopePublished(Builder $query)
    {
        return $query->whereDate("published_at", "<=", Carbon::now());
    }

    public function scopeIsPinned(Builder $query)
    {
        return $query->where("is_pinned", true);
    }
}
