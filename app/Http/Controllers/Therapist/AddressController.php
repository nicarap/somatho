<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use App\Http\Requests\Therapist\Address\UserAddress\changeDefaultAddressRequest;
use App\Models\Address;
use App\Models\Therapist;
use App\Models\UserAddress;
use App\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct(private AddressService $addressService)
    {
        
    }

    public function changeDefaultAddress(changeDefaultAddressRequest $request, Therapist $therapist, Address $address)
    {
        $this->addressService->changeDefaultAddress($therapist, $address, $request->get('is_default'));
    }
}
