<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'frontend',
            ],
            [
                'name' => 'backend',
            ],
            [
                'name' => 'fullstack',
            ]
            ];

            foreach ($types as $type) {
                Type::create($type);
            }
    }
}
