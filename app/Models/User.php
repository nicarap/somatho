<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'tel',
        'birthdate'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retrieve address of the model
     *
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'model');
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

    /**
     * retrieve user by mail
     *
     * @return HasMany
     */
    public static function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, "patient_id");
    }
}
