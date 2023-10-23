<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\traitmentDTO;
use App\DataTransferObjects\UserDTO;
use App\Exceptions\UserAlreadyExist;
use App\Models\Traitment;
use App\Repositories\TraitmentRepository;
use Carbon\Carbon;

class TraitmentService
{
    public function __construct(private TraitmentRepository $traitmentRepository)
    {
    }

    public function create(traitmentDTO $traitment): Traitment
    {
        return $this->traitmentRepository->create($traitment);
    }

    public function save(Traitment $traitment): Traitment
    {
        return $this->traitmentRepository->save($traitment);
    }

    public function destroy(Traitment $traitment): bool
    {
        return $this->traitmentRepository->delete($traitment);
    }

    public function therapistValidation(Traitment $traitment, Carbon $date)
    {
        $this->traitmentRepository->update($traitment, ['therapist_validated_at' => $date]);
    }

    public function patientValidation(Traitment $traitment, Carbon $date)
    {
        $this->traitmentRepository->update($traitment, ['patient_validated_at' => $date]);
    }
}
