<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Traitment;
use App\Models\Note;
use App\Repositories\NoteRepository;
use App\Repositories\TraitmentRepository;
use Carbon\Carbon;

class TraitmentService
{
    public function __construct(private TraitmentRepository $traitmentRepository, private NoteRepository $noteRepository)
    {
    }

    public function create(array $attributes): Traitment
    {
        return $this->traitmentRepository->create($attributes);
    }

    public function save(Traitment $traitment): Traitment
    {
        return $this->traitmentRepository->save($traitment);
    }

    public function addNote(Traitment $traitment, array $attributes): Note
    {
        return $this->noteRepository->create($traitment, $attributes);
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
