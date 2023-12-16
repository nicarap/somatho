<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'label',
        'name',
        'context',
        'postcode',
        'city',
        'longitude',
        'latitude',
        'is_verified',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function therapists(): BelongsToMany
    {
        return $this->belongsToMany(Therapist::class);
    }
}
