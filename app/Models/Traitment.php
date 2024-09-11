<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Therapist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        "canceled_at",
        "paid_at",
        "info_realized",
        'price',
        'travel_cost',
        'discount',
        "note",
        "therapist_id",
        "patient_id",
        "address_id",
        "invoice_id"
    ];

    protected $cast = [
        'canceled_at' => 'datetime',
        'realized_at' => 'datetime',
        'paid_at' => 'datetime',
        'programmed_start_at' => 'datetime',
        'programmed_end_at' => 'datetime',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
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

    public function isRealized(): bool
    {
        return !is_null($this->realized_at);
    }

    public function isPassed(): bool
    {
        return $this->programmed_end_at < Carbon::now();
    }

    public function isCanceled(): bool
    {
        return $this->canceled_at !== null;
    }

    public function wasBilled(): bool
    {
        return $this->invoice()->exists();
    }

    public function isBegins(): bool
    {
        return $this->programmed_start_at <= Carbon::now();
    }

    public function isInProgress(): bool
    {
        return $this->isBegins() && !$this->isPassed() && !$this->isCanceled();
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

    public function scopeNotBilledYet(Builder $query): Builder
    {
        return $query->doesntHave('invoice');
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
