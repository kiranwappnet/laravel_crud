<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AddState extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
              

            DB::table('states')->insert([    
         
                  'statename' => 'Gujarat',
         
                  
         
               ]); 
               
            DB::table('states')->insert(
                [
                    'statename' => 'Rajsthan',
                ]
                );
         
           
    }
}
