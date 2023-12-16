<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traitment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        "traitment_id",
        "filename",
        "paid_at",
        "therapist_street",
        "therapist_context",
        "therapist_postcode",
        "therapist_city",
        "patient_street",
        "patient_context",
        "patient_postcode",
        "patient_city",
    ];

    protected $cast = [
        'realized_at' => 'datetime',
    ];

    public function traitment(): BelongsTo
    {
        return $this->belongsTo(Traitment::class);
    }

    public static function findByNumber($number): Invoice|null
    {
        return Invoice::firstWhere("number", $number);
    }
}
