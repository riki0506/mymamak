<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
        DB::table('users')->insert([
                'name' => 'Name' . $i,
                'email' => $i . '@email.com',
                'password' => 'Password' . $i,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
         ]);
        }
    }
}
