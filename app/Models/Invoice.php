<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traitment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "number",
        "filename",
        "paid_at",
        "therapist_street",
        "therapist_context",
        "therapist_postcode",
        "therapist_city",
        "patient_id",
        "patient_street",
        "patient_context",
        "patient_postcode",
        "patient_city",
        "therapist_id",
        "start_at",
        "end_at"
    ];

    protected $cast = [
        'paid_at' => 'datetime',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];

    public function traitments(): HasMany
    {
        return $this->hasMany(Traitment::class);
    }

    public function therapist(): BelongsTo
    {
        return $this->belongsTo(Therapist::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'patient_has_invoices');
    }

    public static function findByNumber($number): Invoice|null
    {
        return Invoice::firstWhere("number", $number);
    }
}
