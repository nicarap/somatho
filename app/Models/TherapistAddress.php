<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TherapistAddress extends Pivot
{
    protected $table = "therapist_has_addresses";
    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
