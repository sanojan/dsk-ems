<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = 
        [
            ['id' => '1', 
             'name' => 'SRI LANKA ADMINISTRATIVE SERVICE'
            ],

            ['id' => '2', 
             'name' => 'SRI LANKA ENGINEERING SERVICE'
            ], 

            ['id' => '3', 
             'name' => 'SRI LANKA ACCOUNTANTS SERVICE'
            ], 
            
            ['id' => '4', 
             'name' => 'SRI LANKA PLANNING SERVICE'
            ], 
            
            ['id' => '5', 
             'name' => 'SRI LANKA SCIENTIFIC SERVICE'
            ],

            ['id' => '6', 
            'name' => 'SRI LANKA ARCHITECTURAL SERVICE'
            ],

            ['id' => '7', 
            'name' => 'SRI LANKA INFORMATION & COMMUNICATION TECHNOLOGY SERVICE'
            ],

            ['id' => '8', 
            'name' => 'TRANSLATORS SERVICE'
            ],

            ['id' => '9', 
            'name' => 'LIBRARIANS SERVICE'
            ],

           ['id' => '10', 
           'name' => 'DEVELOPMENT OFFICERS SERVICE'
           ],

           ['id' => '11', 
           'name' => 'MANAGEMENT SERVICE OFFICER SERVICE'
           ],

           ['id' => '12', 
           'name' => 'DRIVERS SERVICE'
           ],

           ['id' => '13', 
           'name' => 'OFFICE EMPLOYEE SERVICE'
           ],

           ['id' => '14', 
           'name' => 'SRI LANKA TECHNOLOGICAL SERVICE'
           ],

           ['id' => '15', 
           'name' => 'GRAMA NILADHARI SERVICE'
           ],

        ];

        foreach($services as $service){
            Service::create($service);
        }
    }
}
