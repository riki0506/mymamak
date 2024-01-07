<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
        DB::table('restaurants')->insert([
                'name' => 'Restaurant' . $i,
                'address' => 'Address' . $i,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        }
    }
}
