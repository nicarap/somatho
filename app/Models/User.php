<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuids, Notifiable, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tel'
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditExclude  = [
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retrieve address of the model
     *
     * @return belongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'user_has_addresses', 'model_id');
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'model');
    }

    /**
     * retrieve user by mail
     *
     * @return HasMany
     */
    public static function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * retrieve therapists
     *
     * @return HasMany
     */
    public function therapists(): BelongsToMany
    {
        return $this->belongsToMany(Therapist::class, 'therapists_has_patients');
    }

    /**
     * retrieve patient traitments
     *
     * @return HasMany
     */
    public function traitments(): hasMany
    {
        return $this->hasMany(Traitment::class, 'patient_id');
    }

    public function therapistTraitments(Therapist $therapist)
    {
        return $this->traitments()->where('therapist_id', $therapist->id);
    }

    public function scopeForTherapist(Builder $query, Therapist $therapist): Builder
    {
        return $query->whereRelation('therapists', 'id', $therapist->id);
    }
}
