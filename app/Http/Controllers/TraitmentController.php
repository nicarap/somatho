<?php

namespace App\Http\Controllers;

use App\Http\Requests\Traitments\StoreTraitmentRequest;
use App\Models\Traitment;
use App\Services\TraitmentService;
use Illuminate\Http\Request;

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
