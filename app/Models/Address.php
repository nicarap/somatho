<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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

    public function userAdresses()
    {
        return $this->belongsToMany(UserAddress::class, 'user_has_addresses');
    }

    public function patients(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'model', 'user_has_addresses', 'address_id', 'model_id');
    }

    public function therapists(): MorphToMany
    {
        return $this->morphedByMany(Therapist::class, 'model', 'user_has_addresses', 'address_id', 'model_id');
    }
}
