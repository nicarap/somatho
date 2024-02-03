<?php

namespace App\Policies;

use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use Carbon\Carbon;

class TraitmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(Therapist $therapist)
    {
        return true;
    }

    // public function update(Therapist $therapist, Traitment $traitment)
    // {
    //     return !$traitment->isRealized();
    // }

    public function delete(Therapist $therapist, Traitment $traitment)
    {
        return $traitment->programmed_start_at > Carbon::now();
    }
}
