<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Flux;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $colors = ['primary', 'secondary', 'info', 'success', 'warning', 'danger'];
        $links = ["https://www.cert.ssi.gouv.fr/feed/", "https://www.canardpc.com/feed/", "http://feeds.feedburner.com/phoenixjp/rXiW", "https://www.tomshardware.fr/feed/"];
        $icons = ['fa-file', 'fa-filter', 'fa-folder', 'fa-folder-open', 'fa-code', 'fa-bug', 'fa-user-secret', 'fa-microchip', 'fa-terminal', 'fa-keyboard', 'fa-laptop-code'];
        
        // Create a user
        $this->user = User::factory()->create([
            'name' => 'Tata tata',
            'email' => 'tata@tata.fr',
        ]);

        // Create parent categories
        $parentCategories = Category::factory(2)->create([
            'user_id' => $this->user->id,
            'icon' => $icons[array_rand($icons)],
        ]);
        // Create child categories for each parent category
        $childCategories = collect();
        $parentCategories->each(function ($parentCategory) use ($icons, &$childCategories) {
            $children = Category::factory(5)->create([
                'parent_id' => $parentCategory->id, // Assign the parent category ID
                'user_id' => $parentCategory->user_id, // Use the same user ID as the parent
                'icon' => $icons[array_rand($icons)],
            ]);
            $childCategories = $childCategories->concat($children);
        });
        // Concatenate parent and child categories
        $this->categories = $parentCategories->concat($childCategories);

        // Create 3 fluxes for random child categories
        Flux::factory(3)->create([
            'category_id' => Category::inRandomOrder()->first()->id,
            'color' => $colors[array_rand($colors)],
            'link' => $links[array_rand($links)],
        ]);
    }

    public function test_access_dashboard_index(): void
    {
        $response = $this->actingAs($this->user)->get('/categories');
        
        $response->assertOk();
        $response->assertViewIs('dashboard');

    }
}
