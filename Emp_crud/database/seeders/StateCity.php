<?php

namespace Database\Seeders;
use App\Models\States;
use App\Models\City;

use Illuminate\Database\Seeder;

class StateCity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $state = States::create(['statename' => 'Uttar Pradesh']);

        City::create(['state_id' => $state->id, 'cityname' => 'Ayodhya']);
        City::create(['state_id' => $state->id, 'cityname' => 'Mathura']);


    }
}
