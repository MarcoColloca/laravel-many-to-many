<?php

namespace Database\Seeders;

use App\Http\Traits\Sluggable;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['html','css', 'bootstrap', 'js', 'vue', 'sql', 'php', 'laravel'];

        foreach ($technologies as $technology_name) {
            $new_technology = new Technology();

            $new_technology->name = $technology_name;
            $new_technology->slug = Str::slug($new_technology->name);

            $new_technology->save();

            // $new_technology->posts()->attach($posts_id_coll->random(10)->all());
        }

    }
}
