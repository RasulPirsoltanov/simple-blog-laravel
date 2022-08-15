<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use Faker\Factory as Faker;
use Faker\Provider\Image;
class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $faker=Faker::create();
        for($i=0;$i<10;$i++){
            $title=$faker->sentence($nbWords = 6, $variableNbWords = true) ;
            DB::table('articles')->insert([
                'category_id'=>rand(1,5),
                'title'=>$title,
                'name'=>$faker->name,
                'slug'=>Str::slug($title),
                'content'=>$faker->text,
                'status'=>rand(0,1),
                'image'=>"https://www.interactivemedia.az/wp-content/uploads/2020/03/tercume1.jpg",
                'created_at'=>$faker->dateTime($max = 'now'),
                'updated_at'=>now(),
            ]);
        }
    }
}
