<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->truncate();
        $data = array (
        	[
        		'name' => 'TV Series',
        		'slug' => Str::slug('TV Series')
        	],
        	[
        		'name' => 'OVA',
        		'slug' => Str::slug('OVA')
        	],
        	[
        		'name' => 'Movie',
        		'slug' => Str::slug('Movie')
        	]
        );
        DB::table('types')->insert($data);
    }
}
