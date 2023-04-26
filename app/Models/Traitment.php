<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Invoice;
use App\Models\Therapist;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Traitment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'realized_at'
    ];

    protected $cast = [
        'realized_at' => 'datetime',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function Therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function Patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
