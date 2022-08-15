<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count=0;
        $faker=Faker::create();
        $array = ['Haqqimizda', 'Kariyera', 'Missiyamiz', 'texnalogiya'];
        foreach ($array as $category) {
            $count++;
            DB::table('pages')->insert([
                'title'=>$category,
                'slug'=>Str::slug($category),
                'content'=>$faker->text,
                'image'=>'https://image.shutterstock.com/image-photo/category-word-written-on-wood-260nw-1336568840.jpg',
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
