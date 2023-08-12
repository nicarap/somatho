<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\Therapist;
use App\Models\User;
use App\Models\UserAddress;
use App\Repositories\AddressRepository;
use App\Repositories\UserAddressRepository;
use Illuminate\Support\Arr;

class AddressService
{
    public function __construct(
        private AddressRepository $addressRepository, 
        private TherapistService $therapistService,
        private UserAddressRepository $userAddressRepository)
    {
        
    }

    public function create(array $attributes, User|Therapist $requester)
    {
        $address = $this->addressRepository->create($attributes);
        $this->attachTo($address, $requester);
        $this->changeDefaultAddress($requester, $address, Arr::get($attributes, 'default'));

        return $address;
    }

    public function attachTo(Address $address, Therapist|User $user)
    {
        if($user instanceof(Therapist::class)){
            return $this->therapistService->attachAdress($user, $address);
        }
    }

    public function changeDefaultAddress(Therapist $therapist, Address $address, bool $is_default)
    {
        $userAddress = UserAddress::forUser($therapist)->forAddress($address)->first();
        
        foreach($therapist->addresses as $other_address)
        {
            if($other_address->id !== $userAddress->address_id){
                $this->unmarkAsDefault(UserAddress::forUser($therapist)->forAddress($other_address)->first());
            }else {
                if($is_default){
                    $this->markAsDefault($userAddress);
                }
            }
        }

        return $userAddress;
    }

    public function markAsDefault(UserAddress $userAddress)
    {
        return $this->userAddressRepository->updateDefaultAttribute($userAddress, true);
    }

    public function unmarkAsDefault(UserAddress $userAddress)
    {
        return $this->userAddressRepository->updateDefaultAttribute($userAddress, false);
    }

    public function destroy(Address $address)
    {
        // TODO : if adress is in use traitments don't delete
        
        $address->userAdresses()->sync([]);
        return $this->addressRepository->destroy($address);
    }
}