<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Therapist;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Traitment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'programmed_start_at',
        'programmed_end_at',
        'realized_at',
        'therapist_validated_at',
        'patient_validated_at',
        'price',
        'travel_cost',
        'discount',
        'location_choosed',
        'address',
        'postal_code',
        'location'

    ];

    protected $cast = [
        'realized_at' => 'datetime',
        'programmed_start_at' => 'datetime:Y-m-d',
        'programmed_end_at' => 'datetime:d-m-Y',
    ];

    protected function programmedStartAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('Y-m-d H:i'),
        );
    }

    protected function programmedEndAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('Y-m-d h:i'),
        );
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function scopeForTherapist(Builder $query, Therapist $therapist): Builder
    {
        return $query->where('therapist_id', $therapist->id);
    }
    
    /**
     * Get the next traitment of a terapist.
     */
    public function scopeNextTraitment(): Builder
    {
        return $this->startAt(Carbon::now());
    }

    public function scopeForPatient(Builder $query, User $patient): Builder
    {
        return $query->where('patient_id', $patient->id);
    }

    public function scopeStartAt(Builder $query, $date): Builder
    {
        return $query->where('programmed_start_at', '>=', Carbon::parse($date)->format('Y-m-d'));
    }
    public function scopeEndAt(Builder $query, $date): Builder
    {
        return $query->where('programmed_end_at', '<=', Carbon::parse($date)->endOfDay());
    }
}
