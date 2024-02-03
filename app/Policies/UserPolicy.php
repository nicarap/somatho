<?php

namespace App\Policies;

use App\Models\Therapist;
use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function delete()
    {
        return false;
    }
}
