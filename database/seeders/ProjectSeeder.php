<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected function fakeContributors(Faker $faker){

        $contributors_number = rand(0, 5);
        if($contributors_number === 0){
            $contributors_list = null;
        }else{

            $contributors = [];
    
            for ($i=0; $i < $contributors_number ; $i++) { 
                # code...
                $contributors [] = $faker->name();
            }
    
            $contributors_list = implode(', ', $contributors);
    
        }
        
        return [$contributors_number, $contributors_list];

    }



    public function run(Faker $faker): void
    {
        
        $types = Type::all(); // Collection di oggetti Type

        /** Tramite un metodo presente dentro la Collection */
        $ids = $types->pluck('id')->all(); // Array di ids 
        
        
        // Creazione di dati temporanei tramite Faker
        for ($i=0; $i < 10 ; $i++) { 

            list($contributors_number, $contributors_list) = $this->fakeContributors($faker);

            # code...
            $project = new Project();

            $project->name = $faker->sentence(3);
            $project->slug = Str::slug($project->name);
            $project->link = $faker->url();
            $project->description = $faker->optional()->text(500);;
            $project->date_of_creation = $faker->dateTimeBetween('-1 year', 'now');
            $project->is_public = $faker->randomElement([true, false]);
            $project->contributors = $contributors_number;
            $project->contributors_name = $contributors_list;
            $project->type_id = $faker->optional()->randomElement($ids);

            $project->save();
            // dump($project);
        }
    }
}
