<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "content",
        "value",
        "patient_id"
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
