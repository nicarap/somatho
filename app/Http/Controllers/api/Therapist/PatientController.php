<?php

namespace App\Http\Controllers\api\Therapist;

use App\Http\Controllers\Controller;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request, Therapist $therapist)
    {        
        return $therapist->patients()->get();
    }
}
