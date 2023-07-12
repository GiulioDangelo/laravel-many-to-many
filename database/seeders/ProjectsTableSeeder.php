<?php

namespace Database\Seeders;


use App\Models\Type;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types = Type::all()->pluck('id');
        // $types = shift();
        $technologies = Technology::all()->pluck('name');

        for ($i = 0; $i < 50; $i++) {
            $title = $faker->words(rand(2,10),true);
            $slug = Str::slug($title);

            $project = Project::create([
                'type_id'       => $faker->randomElement($types),
                // 'type_id'    => rand(1, 3),   //$faker->randomElement($types)->id
                'title'         => $faker->words(3, true),
                'slug'          => Project::slugger($title),
                'url_image'     => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'content'       => $faker->paragraph(rand(2, 20)),
            ]);
            
            $project->technologies()->sync($faker->randomElements($technologies, null));
        }

    }
}
