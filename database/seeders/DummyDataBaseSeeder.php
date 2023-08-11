<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use App\Models\Therapist;
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
            Therapist::factory()->forAddress()->create();
        }
        for($i=0; $i< $nb_patients;$i++){
            User::factory()->forAddress()->create();
        }
        
        $patients = User::all();
        $therapists = Therapist::all();

        foreach($patients as $patient){
            $patient->therapists()->attach($therapists->random()->first());
        }
    }
}
