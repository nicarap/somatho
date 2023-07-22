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
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function isTherapist()
    {
        return $this->hasRole(Roles::THERAPIST);
    }

    public function isPatient()
    {
        return $this->hasRole(Roles::PATIENT);
    }

    public function isService()
    {
        return $this->hasRole(Roles::SERVICE);
    }

    public static function getPatients(){
        return User::role(Roles::PATIENT)->get();
    }

    public static function getTherapist(){
        return User::role(Roles::THERAPIST)->get();
    }

    public static function findByEmail($email){
        return User::where('email', $email)->first();
    }

    
    public function patients(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'therapists_has_patients', 'patient_id', 'therapist_id');
    }
    

    public function therapists(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'therapists_has_patients', 'therapist_id', 'patient_id');
    }

    public function traitments(): HasMany
    {
        return $this->hasMany(Traitment::class);
    }

}
