<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(TypeSeeder::class);
        // $this->call(FilmSeeder::class);
        // $this->call(EpisodeSeeder::class);
        // $this->call(CategoryFilmSeeder::class);

		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
