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
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traitment extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'programmed_start_at',
        'programmed_end_at',
        'realized_at',
        'therapist_validated_at',
        'patient_validated_at',
        "realized_at",
        "info_realized",
        'price',
        'travel_cost',
        'discount',
    ];

    protected $cast = [
        'realized_at' => 'date',
        'programmed_start_at' => 'date',
        'programmed_end_at' => 'date',
    ];

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'model');
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

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
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
    public function scopeNextTraitment(Builder $query): Builder
    {
        return $query->startAt(Carbon::now());
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
