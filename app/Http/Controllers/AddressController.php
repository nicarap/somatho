<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function __construct(private AddressService $addressService)
    {
        
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try{
            $this->addressService->create($request->all(), Auth::user());

            DB::commit();
        }catch(\Exception $e){
            report($e);
            DB::rollBack();
            
            return redirect()->back()->with(['flash' => ['type' => 'error', 'message' => 'Impossible d\'ajouter l\'adresse.']]);
        }

        return redirect()->back()->with(['flash' => ['type' => 'success', 'message' => 'Adresse ajoutée avec']]);
    }

    public function destroy(Request $request, Address $address)
    {
        $this->addressService->destroy($address);
    }
}
