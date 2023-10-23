<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\traitmentDTO;
use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Models\Therapist;
use App\Models\Traitment;
use App\Models\User;
use App\Services\TraitmentService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TraitmentController extends Controller
{

    public function __construct(private TraitmentService $traitmentService)
    {}

    public function store(StoreTraitmentRequest $request)
    {
        dd($request);
    }

    public function update(Request $request, Traitment $traitment)
    {
        dd($traitment);
    }
}
