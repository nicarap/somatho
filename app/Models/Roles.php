<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Models\Role;

class Roles extends Role
{
    use HasFactory;

    const SERVICE = 'service';
    const ADMIN = 'administrator';
    const PATIENT = 'patient';
    const THERAPIST = 'therapist';
    
}
