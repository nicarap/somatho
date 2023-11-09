<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\DataTransferObjects\traitmentDTO;
use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Http\Resources\TherapistResource;
use App\Models\Address;
use App\Models\Therapist;
use App\Models\User;
use App\Models\Traitment;
use App\Services\TraitmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TraitmentController extends Controller
{
    public function __construct(private TraitmentService $traitmentService)
    {
    }

    public function store(StoreTraitmentRequest $request, Therapist $therapist)
    {
        $this->authorize('create', [Traitment::class, User::find($request->get('patient_id'))]);

        DB::beginTransaction();

        try {
            $traitment = $this->traitmentService->create(traitmentDTO::from(array_merge($request->all(), [
                'price' => 70,
                'therapist_id' => $therapist->id
            ])));

            if ($request->get('note')) {
                $this->traitmentService->addNote($traitment, $request->get('note'));
            }

            $this->traitmentService->therapistValidation($traitment, Carbon::now());
            $this->traitmentService->patientValidation($traitment, Carbon::now());

            DB::commit();
        } catch (\Exception $e) {
            report($e);
            dd($e);
            DB::rollBack();

            return back()->with(['flash' => ['type' => 'error', 'message' => 'La réservation n\'a pas pu être créée']]);
        }

        return back()->with(['flash' => ['type' => 'success', 'message' => 'Réservation créée']]);
    }

    public function update(Request $request, Therapist $therapist, Traitment $traitment)
    {
        dd($traitment);
    }

    public function destroy(Request $request, Therapist $therapist, Traitment $traitment)
    {
        DB::beginTransaction();

        try {
            $this->traitmentService->destroy($traitment);
            DB::commit();
        } catch (\Exception $e) {
            report($e);
            DB::rollBack();

            return back()->with(['flash' => ['type' => 'error', 'message' => 'La réservation n\'a pas pu être annulée']]);
        }

        return back()->with(['flash' => ['type' => 'success', 'message' => 'Réservation annulée']]);
    }
}
