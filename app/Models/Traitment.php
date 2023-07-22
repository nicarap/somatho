<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Therapist;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Traitment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'realized_at'
    ];

    protected $cast = [
        'realized_at' => 'datetime',
    ];

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function Therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
