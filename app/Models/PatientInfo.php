<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientInfo extends Model
{
    use HasFactory, HasUuids;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }
}
