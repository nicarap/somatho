<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Traitment;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Patient extends User
{
    use HasFactory;

    protected $table = 'users';
    protected $guard_name = 'web';

    public static function boot()
    {
        parent::boot();
        // static::addGlobalScope('patient', function (Builder $query){
            // return $query->whereHas('roles', function (Builder $query2){
            //     return $query2->where('role_id', Roles::findByName(Roles::PATIENT)->id);
            // });
        // });
    }

    public function patientInfo(): HasOne
    {
        return $this->hasOne(PatientInfo::class, 'user_id');
    }

    public function therapists(): BelongsToMany
    {
        return $this->belongsToMany(Therapist::class, 'therapists_has_patients');
    }

    public function traitments(): HasMany
    {
        return $this->HasMany(Traitment::class);
    }

    public static function scopeHasTherapist(Builder $query, Therapist $therapist)
    {
        return $query->whereHas('traitments', function (Builder $query2) use ($therapist) {
            return $query2->where('therapist_id', $therapist->id);
        });
    }
}
