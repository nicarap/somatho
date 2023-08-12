<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Address extends Model
{
    use HasFactory, HasUuids;

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

    public function users(): MorphToMany
    {
        return $this->morphToMany(User::class, 'adressable');
    }
    
    public function therapists(): MorphToMany
    {
        return $this->morphToMany(Therapist::class, 'adressable');
    }

}
