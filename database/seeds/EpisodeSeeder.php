<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        DB::table('episodes')->truncate();

        $films = DB::table('films')->get();
        foreach ($films as $film) {
            $data = array ();
            $rand = rand(1,10);
            for ($i=1; $i<=$rand; $i++) {
                $name = $film->name.' Episode '.$i;
                $data[] = array (
                    'name' => $name,
                    'ep' => $i,
                    'slug' => Str::slug($name),
                    'film_id' => $film->id,
                    'drive' => uniqid(20),
                    'status' => 'uploaded',
                    'show' => 1
                );
            }
            DB::table('episodes')->insert($data);
        }
    }

}
