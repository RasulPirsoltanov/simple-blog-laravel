<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('admins')->insert([
                'name' => 'Rasul Pirsoltanov',
                'Password' => bcrypt(102030),
                'email' => 'resulresull510@gmail.com',
            ]);
        }
    }
}
