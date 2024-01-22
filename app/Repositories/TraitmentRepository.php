<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Traitment;
use Illuminate\Support\Arr;

class TraitmentRepository
{
    public function create(array $attributes): Traitment
    {
        $traitment = Traitment::make($attributes);
        $traitment->therapist()->associate(Arr::get($attributes, "therapist_id"));
        $traitment->patient()->associate(Arr::get($attributes, "patient_id"));
        $traitment->address()->associate(Arr::get($attributes, "address_id"));

        $this->save($traitment);

        return $traitment;
    }

    public function save(Traitment $traitment)
    {
        $traitment->save();

        return $traitment;
    }

    public function update(Traitment $traitment, array $attributes)
    {
        $traitment->update($attributes);

        return $traitment;
    }

    public function delete(Traitment $traitment)
    {
        return $traitment->delete();
    }
}
