<?php

namespace App\Http\Controllers\api\Therapist;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Therapist;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request, Therapist $therapist)
    {
        return $therapist->addresses;
    }
}
