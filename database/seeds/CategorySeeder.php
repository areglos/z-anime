<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $data = array (
        	[      
                'name' => 'Đời Thường',
        		'slug' => Str::slug('Đời Thường'),
                
        	],
            [      
                'name' => 'Thể Thao',
                'slug' => Str::slug('Thể Thao'),
                
            ],
            [      
                'name' => 'Harem',
                'slug' => Str::slug('Harem'),
                
            ],
            [      
                'name' => 'Shounen',
                'slug' => Str::slug('Shounen'),
                
            ],
            [      
                'name' => 'Học Đường',
                'slug' => Str::slug('Học Đường'),
                
            ],
            [      
                'name' => 'Drama',
                'slug' => Str::slug('Drama'),
                
            ],
            [      
                'name' => 'Trinh Thám',
                'slug' => Str::slug('Trinh Thám'),
                
            ],
            [      
                'name' => 'Blu-ray',
                'slug' => Str::slug('Blu-ray'),
                
            ],
            [      
                'name' => 'Fantasy',
                'slug' => Str::slug('Fantasy'),
                
            ],
        );
        DB::table('categories')->insert($data);
    }
}
