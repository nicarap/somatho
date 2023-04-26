<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traitment;
use Illuminate\Database\Eloquent\Builder;

class Patient extends User
{
    use HasFactory;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tel',
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('patient', function (Builder $query){
            return $query->whereHas('roles', function (Builder $query2){
                return $query2->where('role_id', Roles::findByName(Roles::PATIENT)->id);
            });
        });
    }

    public function therapists(): HasMany
    {
        return $this->hasMany(Therapist::class);
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
