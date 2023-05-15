<?php

namespace App\Http\Controllers;

use App\Http\Requests\Traitments\StoreTraitmentRequest;
use Illuminate\Http\Request;

class TraitmentController extends Controller
{
    public function store(StoreTraitmentRequest $request)
    {
        dd($request);
    }
}
