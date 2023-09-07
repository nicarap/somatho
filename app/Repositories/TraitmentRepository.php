<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Traitment;
use App\DataTransferObjects\traitmentDTO;
use Exception;
use Illuminate\Support\Facades\DB;

class TraitmentRepository
{
    public function create(traitmentDTO $traitmentDTO): Traitment
    {
        $traitment = Traitment::make($traitmentDTO->toArray());
        $traitment->therapist()->associate($traitmentDTO->therapist_id);
        $traitment->patient()->associate($traitmentDTO->patient_id);
        
        $this->save($traitment);
        
        return $traitment;    
    }

    public function save(Traitment $traitment)
    {
        // DB::beginTransaction();
        // try {
            $traitment->save();
        //     DB::commit();
        // }catch(Exception $e){
        //     DB::rollBack();
        //     return false;
        // }        
        return $traitment;        
    }

    public function update(Traitment $traitment, array $attributes){
        DB::beginTransaction();
        try {
            $traitment->update($attributes);
            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
            return false;
        }        
        return $traitment;   
    }

} 