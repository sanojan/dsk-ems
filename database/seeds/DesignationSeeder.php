<?php

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [['id' => '1', 'name' => 'Divisional Secretary'], ['id' => '2', 'name' => 'Chief Management Assistant'], ['id' => '3', 'name' => 'Accountant'], ['id' => '4', 'name' => 'ICT Assistant'], ['id' => '5', 'name' => 'Public Management Officer']];
        
        \App\Designation::create($designations);
    }
}
