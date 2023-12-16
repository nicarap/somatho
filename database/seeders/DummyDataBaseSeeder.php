<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use App\Models\Therapist;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nb_patients = 5;

        DB::beginTransaction();

        try {
            $me = Therapist::create([
                'name' => 'Raphael Lebon',
                'email' => 'raphael.lebon@tessi.fr',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);

            $adresses = Address::factory()->count(2)->create();
            foreach ($adresses as $index => $adress) {
                $me->addresses()->attach($adress);
            }

            for ($i = 0; $i < $nb_patients; $i++) {
                $user = User::factory()->create();
                $adress = Address::factory()->create();

                $adress->patient()->associate($user);
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
