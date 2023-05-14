<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use App\Models\TherapistInfo;
use App\Models\Traitment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Therapist extends User
{
    use HasFactory;
    
    protected $guard_name = 'web';
    protected $table = 'users';

    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope('patient', function (Builder $query){
        //     return $query->whereHas('roles', function (Builder $query2){
        //         return $query2->where('role_id', Roles::findByName(Roles::THERAPIST)->id);
        //     });
        // });
    }

    public function therapistInfo(): HasOne
    {
        return $this->hasOne(TherapistInfo::class, 'user_id');
    }

    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(Patient::class, 'therapists_has_patients');
    }

    public function traitments(): HasMany
    {
        return $this->hasMany(Traitment::class);
    }
}
