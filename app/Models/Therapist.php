<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Traitment;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Therapist extends User
{
    use HasFactory;
    protected $guard_name = 'web';
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'siren',
    ];

    public static function boot()
    {
        parent::boot();
        static::addGlobalScope('patient', function (Builder $query){
            return $query->whereHas('roles', function (Builder $query2){
                return $query2->where('role_id', Roles::findByName(Roles::THERAPIST)->id);
            });
        });
    }

    public function patients(){
        return $this->hasMany(Patient::class);
    }

    public function traitments(): HasMany
    {
        return $this->hasMany(Traitment::class);
    }
}
