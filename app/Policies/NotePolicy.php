<?php

namespace App\Policies;

use App\Models\Therapist;
use App\Models\User;

class NotePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // public function create(Therapist $therapist, User $patient)
    // {
    //     if ($therapist->patients->contains($patient)) {
    //         return true;
    //     }
    // }

    public function create()
    {
        return true;
    }
}
