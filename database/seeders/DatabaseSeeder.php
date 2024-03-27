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
        // Création d'un premier compte utilisateur
        User::factory()->create([
            'name' => 'Tata tata',
            'email' => 'tata@tata.fr',
        ]);
        // Création de 2 catégories parentes appartenant à l'utilisateur du dessus
        Category::factory(2)->create([
            'user_id' => 1,
        ]);
        // Création de 5 catégories enfantes des deux parents du dessus
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(1, 2),
                'user_id' => 1,
            ]);
        }
        
        // Création d'un second compte utilisateur
        User::factory()->create([
            'name' => 'Toto toto',
            'email' => 'toto@toto.fr',
        ]);
        // Création de 2 catégories parentes appartenant à l'utilisateur du dessus
        Category::factory(2)->create([
            'user_id' => 2,
        ]);
        // Création de 5 catégories enfantes des deux parents du dessus
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(8, 9),
                'user_id' => 2,
            ]);
        }
    }
}
