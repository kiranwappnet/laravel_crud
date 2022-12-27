<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

           
                    
                    'user' => 1,
                    'firstname'=>$this->faker->name(),
                    'middlename'=>$this->faker->lastName(),
                    'lastname'=>$this->faker->name(),
                    'dob'=>$this->faker->date(),
                    'email'=>$this->faker->safeEmail(),
                    'mobile'=>$this->faker->phoneNumber(),
                    'address'=>$this->faker->text(),
                    'state'=>$this->faker->text(),
                    'city'=>$this->faker->text(),
                    'image'=>$this->faker->imageUrl(640,480),
                    'file'=>$this->faker->filePath(),

        
              
            //
        ];
    }
}
