<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $data = array (
        	[      
                'name' => 'Bùi Tuyến Lĩnh',
        		'email' => 'linh@gmail.com',
                'password' => bcrypt('123456'),
                'google_id' => null,
                'role' => 'admin',
                'active' => 1
        	],
            [      
                'name' => 'Lý Bé Ngoan',
                'email' => 'ngoan@gmail.com',
                'password' => bcrypt('ngoan@300699'),
                'google_id' => null,
                'role' => 'manager',
                'active' => 1
            ],
        );
        DB::table('users')->insert($data);
    }
}
