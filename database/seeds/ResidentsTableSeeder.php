<?php

use App\Resident;
use Illuminate\Database\Seeder;

class ResidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Resident', 50)->create(['facility' => 'Demo']);

        $residents = Resident::all();

        foreach($residents as $resident){
            factory('App\Transaction', 20)->create(['resident_id' => $resident->id]);
            factory('App\Note', 50)->create(['resident_id' => $resident->id]);
        }
    }
}
