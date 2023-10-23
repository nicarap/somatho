<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Traitment;
use App\DataTransferObjects\traitmentDTO;
use Exception;
use Illuminate\Support\Facades\DB;

class TraitmentRepository
{
    public function create(traitmentDTO $traitmentDTO): Traitment
    {
        $traitment = Traitment::make($traitmentDTO->toArray());
        $traitment->therapist()->associate($traitmentDTO->therapist_id);
        $traitment->patient()->associate($traitmentDTO->patient_id);
        $traitment->address()->associate($traitmentDTO->address_id);

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
