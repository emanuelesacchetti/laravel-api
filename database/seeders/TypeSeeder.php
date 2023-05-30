<?php

namespace Database\Seeders;
use App\Models\Type;
use illuminate\support\Str;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Lavoro','Hobby','Personali'];

        foreach($types as $type){
            $newType = new Type();
            $newType->name = $type;
            $newType->slug = Str::slug($type, '-');
            $newType->save();
        }

    }
}