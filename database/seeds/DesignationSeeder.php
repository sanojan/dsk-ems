<?php

use Illuminate\Database\Seeder;
use App\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = 
        [
            ['id' => '1', 
             'name' => 'Divisional Secretary'
            ],

            ['id' => '2', 
             'name' => 'Chief Management Assistant'
            ], 

            ['id' => '3', 
             'name' => 'Accountant'
            ], 
            
            ['id' => '4', 
             'name' => 'ICT Assistant'
            ], 
            
            ['id' => '5', 
             'name' => 'Management Service Officer'
            ],

            ['id' => '6', 
            'name' => 'Development Officer'
            ],

            ['id' => '7', 
            'name' => 'Finance Assistant'
            ],

            ['id' => '8', 
            'name' => 'Administrative Officer'
            ],

            ['id' => '9', 
            'name' => 'Deputy Director of Planning'
            ],

            ['id' => '10', 
            'name' => 'Technical Officer'
            ],

            ['id' => '11', 
            'name' => 'Cultural Officer'
            ],

            ['id' => '12', 
            'name' => 'Grama Niladhari'
            ]
        ];
        
        //\App\

        foreach($designations as $designation){
            Designation::create($designation);
        }
    }
}
