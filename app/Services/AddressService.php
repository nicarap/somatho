<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Models\Therapist;
use App\Models\User;
use App\Models\UserAddress;
use App\Repositories\AddressRepository;
use App\Repositories\UserAddressRepository;

class AddressService
{
    public function __construct(
        private AddressRepository $addressRepository,
        private UserAddressRepository $userAddressRepository
    ) {
    }

    // Create a new address with the given data
    public function create(array $address): Address
    {
        $address = $this->addressRepository->create($address);

        return $address;
    }

    public function attachTo(Address $address, Therapist|User $user,  bool $is_default): Address
    {
        if ($user instanceof (Therapist::class)) {
            $address->therapists()->attach($user, ['default' => $is_default]);
        } else if ($user instanceof (User::class)) {
            $address->users()->attach($user, ['default' => $is_default]);
        }

        return $address;
    }

    public function changeDefaultAddress(Therapist $therapist, Address $address, bool $is_default)
    {
        $userAddress = UserAddress::forUser($therapist)->forAddress($address)->first();

        foreach ($therapist->addresses as $other_address) {
            if ($other_address->id !== $userAddress->address_id) {
                $this->unmarkAsDefault(UserAddress::forUser($therapist)->forAddress($other_address)->first());
            } else {
                if ($is_default) {
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
        return $this->addressRepository->delete($address);
    }
}
