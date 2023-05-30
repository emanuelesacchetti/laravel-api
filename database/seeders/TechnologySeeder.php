<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['stampa_3d','programmazione','sport'];

        foreach($technologies as $tech){
            $newTech = new Technology();
            $newTech->name = $tech;
            $newTech->slug = Str::slug($tech, '-');
            $newTech->save();
        }
    }
}
