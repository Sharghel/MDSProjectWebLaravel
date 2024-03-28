<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Flux;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        $colors = ['info', 'success', 'warning', 'danger'];
        $links = ["https://www.cert.ssi.gouv.fr/feed/", "https://www.canardpc.com/feed/", "http://feeds.feedburner.com/phoenixjp/rXiW", "https://www.tomshardware.fr/feed/"];
        $icons = ['fa-file', 'fa-filter', 'fa-folder', 'fa-folder-open', 'fa-code', 'fa-bug', 'fa-user-secret', 'fa-microchip', 'fa-terminal', 'fa-keyboard', 'fa-laptop-code'];
        // Création d'un premier compte utilisateur
        User::factory()->create([
            'name' => 'Tata tata',
            'email' => 'tata@tata.fr',
        ]);
        // Création de 2 catégories parentes appartenant à l'utilisateur du dessus
        Category::factory(2)->create([
            'user_id' => 1,
            'icon' => $icons[random_int(0, count($icons)-1)],
        ]);
        // Création de 5 catégories enfantes des deux parents du dessus
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(1, 2),
                'user_id' => 1,
                'icon' => $icons[random_int(0, count($icons)-1)],
            ]);
        }
        // Creation de 3 Flux rss qui appartienne aux catégories du dessus
        for($i = 0; $i < 3; $i++){
            Flux::factory(1)->create([
                'category_id' => random_int(3, 7),
                'color' => $colors[random_int(0, 3)],
                'link' => $links[random_int(0, 3)],
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
            'icon' => $icons[random_int(0, count($icons)-1)],
        ]);
        // Création de 5 catégories enfantes des deux parents du dessus
        for($i = 0; $i < 5; $i++){
            Category::factory(1)->create([
                'parent_id' => random_int(8, 9),
                'user_id' => 2,
                'icon' => $icons[random_int(0, count($icons)-1)],
            ]);
        }
        // Creation de 3 Flux rss qui appartienne aux catégories du dessus
        for($i = 0; $i < 3; $i++){
            Flux::factory(1)->create([
                'category_id' => random_int(10, 14),
                'color' => $colors[random_int(0, 3)],
                'link' => $links[random_int(0, 3)],
            ]);
        }
    }
}
