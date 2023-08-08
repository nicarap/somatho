<?php

namespace App\Http\Controllers\api\Therapist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request, User $therapist)
    {
        $therapist = User::find($request->user()->id);
        
        return $therapist->patients()->get();
    }
}
