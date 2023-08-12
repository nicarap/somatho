<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Therapist;
use Illuminate\Database\Seeder;

class DummyDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nb_patients = 5;

        $me = Therapist::create([
            'name' => 'Raphael Lebon',
            'email' => 'raphael.lebon@tessi.fr',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        $adresses = Address::factory()->count(2)->create();
        foreach($adresses as $adress){
            $me->addresses()->attach($adress, ['model_type' => Therapist::class]);
        }        

        for($i=0; $i< $nb_patients;$i++){
            User::factory()->hasAttached(Address::factory()->count(1), ['model_type' => User::class])->create();
        }
        
        $patients = User::all();

        foreach($patients as $index => $patient){
            if($index < $nb_patients - 2) $patient->therapists()->attach($me);
        }
    }
}
