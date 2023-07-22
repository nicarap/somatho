<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class Roles extends Role
{
    use HasFactory;

    const SERVICE = 'service';
    const ADMIN = 'administrator';
    const THERAPIST = 'therapist';
    const PATIENT = 'patient';
    
}
