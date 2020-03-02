<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CategoryFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        DB::table('category_film')->truncate();

        $films = DB::table('films')->get();
        foreach ($films as $film) {
            $data = array ();
            $rand = rand(1,10);
            for ($i=1; $i<=$rand; $i++) {
                $data[] = array (
                    'category_id' => $i,
                    'film_id' => $film->id
                );
            }
            DB::table('category_film')->insert($data);
        }
    }

}
