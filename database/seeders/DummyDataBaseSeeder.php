<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\PatientInfo;
use App\Models\Therapist;
use App\Models\TherapistInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nb_therapists = 5;
        $nb_patients = 25;
        for($i=0; $i< $nb_therapists;$i++){
            TherapistInfo::factory()->count(5)->for(Therapist::factory()->forAddress()->create())->create();
        }
        for($i=0; $i< $nb_patients;$i++){
            PatientInfo::factory()->count(15)->for(Patient::factory()->forAddress()->create())->create();
        }
        
        $patients = Patient::all();

        foreach($patients as $patient){
            $patient->therapists()->attach(Therapist::inRandomOrder()->limit(5)->first());
        }
    }
}
