<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserAddress extends Pivot
{

    protected $table = 'user_has_addresses';    
    public $timestamps = false;

    public $cast = [
        'default' => 'Boolean'
    ];

    public function isDefault(): bool
    {
        return $this->default;
    }

    public function scopeForUser(Builder $query, User|Therapist $user)
    {
        return $query->where('model_id', $user->id)->where('model_type', get_class($user));
    }

    public function scopeForAddress(Builder $query, Address $address)
    {
        return $query->where('address_id', $address->id);
    }
}
