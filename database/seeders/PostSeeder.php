<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
        DB::table('posts')->insert([
                'title' => 'Title' . $i,
                'body' => 'Body' . $i,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'country_id' => $i,
                'restaurant_id' => $i,
                'dish_id' => $i,
                'user_id' => $i,
         ]);
        }
    }
}
