<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Tata tata',
            'email' => 'tata@tata.fr',
        ]);
        User::factory()->create([
            'name' => 'Toto toto',
            'email' => 'toto@toto.fr',
        ]);

        Category::factory(2)->create([
            'user_id' => 1,
        ]);
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(1, 2),
                'user_id' => 1,
            ]);
        }
        Category::factory(2)->create([
            'user_id' => 2,
        ]);
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(8, 9),
                'user_id' => 2,
            ]);
        }

    }
}
