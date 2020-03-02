<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('films')->truncate();

        $data = array (
        	[
        		'name' => 'Thế Giới Phép Thuật',
                'slug' => Str::slug('Thế Giới Phép Thuật'),
                'image' => 'uploads/1.jpg',
                'background' => 'uploads/1.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => 24,
        	],
            [
                'name' => 'Trần Hồn Nhai Phần 2',
                'slug' => Str::slug('Trần Hồn Nhai Phần 2'),
                'image' => 'uploads/2.jpg',
                'background' => 'uploads/2.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'NGHỊCH CHUYỂN THỨ NGUYÊN: AI QUẬT KHỞI',
                'slug' => Str::slug('NGHỊCH CHUYỂN THỨ NGUYÊN: AI QUẬT KHỞI'),
                'image' => 'uploads/3.jpg',
                'background' => 'uploads/3.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Nhất Quỷ Nhì Ma Thứ Ba Học Trò',
                'slug' => Str::slug('Nhất Quỷ Nhì Ma Thứ Ba Học Trò'),
                'image' => 'uploads/4.jpg',
                'background' => 'uploads/4.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Mairimashita! Iruma-kun',
                'slug' => Str::slug('Mairimashita! Iruma-kun'),
                'image' => 'uploads/5.jpg',
                'background' => 'uploads/5.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Thú Cưng',
                'slug' => Str::slug('Thú Cưng'),
                'image' => 'uploads/6.jpg',
                'background' => 'uploads/6.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Fate/Grand Order: Zettai Majuu Sensen Babylonia',
                'slug' => Str::slug('Fate/Grand Order: Zettai Majuu Sensen Babylonia'),
                'image' => 'uploads/7.jpg',
                'background' => 'uploads/7.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Vua Hải Tặc',
                'slug' => Str::slug('Vua Hải Tặc'),
                'image' => 'uploads/8.jpg',
                'background' => 'uploads/8.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Heya Camp△',
                'slug' => Str::slug('Heya Camp△'),
                'image' => 'uploads/9.jpg',
                'background' => 'uploads/9.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
            [
                'name' => 'Học Viện Anh Hùng Phần 4',
                'slug' => Str::slug('Học Viện Anh Hùng Phần 4'),
                'image' => 'uploads/10.jpg',
                'background' => 'uploads/10.jpg',
                'view' => rand(10,10000),
                'type_id' => 1,
                'other_name' => null,
                'description' => null,
                'uptop' => Carbon::now(),
                'all_episode' => null,
            ],
        );
        DB::table('films')->insert($data);
    }
}
