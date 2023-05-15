<?php

namespace App\Http\Controllers\api\Therapist;

use App\Http\Controllers\Controller;
use App\Models\Therapist;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $therapist = Therapist::find($request->user()->id);
        
        return $therapist->patients()->get();
    }
}
