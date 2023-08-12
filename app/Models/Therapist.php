<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Therapist extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, Notifiable, \OwenIt\Auditing\Auditable;

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
        return $this->belongsToMany(Address::class, 'user_has_addresses', 'model_id')->withPivot('default');;
    }
    
    /**
     * retrieve patients
     *
     * @return HasMany
     */
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'therapists_has_patients');
    }

    /**
     * retrieve patient traitments
     *
     * @return HasMany
     */
    public function traitments(): hasMany
    {
        return $this->hasMany(Traitment::class);
    }
}