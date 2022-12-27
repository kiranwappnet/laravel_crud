<?php

namespace Database\Seeders;

use Database\Factories\EmployeeFactory as FactoriesEmployeeFactory;
use Illuminate\Database\Seeder;
use Factories\EmployeeFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([

            AddState::class,

        ]);

        \App\Models\Employee::factory(10)->create();
        FactoriesEmployeeFactory::factory()->times(2)->create();


    }
}
