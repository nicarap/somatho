<?php

namespace App\Http\Controllers\api\Patient;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Therapist;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request, User $user)
    {
        return $user->addresses;
    }
}
