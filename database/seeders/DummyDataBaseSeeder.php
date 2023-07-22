<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class DummyDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nb_therapists = 2;
        $nb_patients = 5;
        for($i=0; $i< $nb_therapists;$i++){
            $u = User::factory()->forAddress()->create();
            $u->email = 't_'.$u->email;
            $u->assignRole(Roles::THERAPIST);
            $u->save();
        }
        for($i=0; $i< $nb_patients;$i++){
            $u = User::factory()->forAddress()->create();
            $u->email = 'p_'.$u->email;
            $u->assignRole(Roles::PATIENT);
            $u->save();
        }
        
        $patients = User::getPatients();

        foreach($patients as $patient){
            $patient->therapists()->attach(User::getTherapist()->random()->first());
        }
    }
}
