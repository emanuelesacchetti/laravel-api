<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0;$i<10;$i++){
            $newProject = new Project();
            $newProject->title = $faker->sentence(4);
            $newProject->date = $faker->dateTime();
            $newProject->cover_img = 'https://picsum.photos/200/300';
            $newProject->slug = Str::slug($newProject->title, '-'); 
            $newProject->content = $faker->text(100); 
            $newProject->save();
        }
    }
}
