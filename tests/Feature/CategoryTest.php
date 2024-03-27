<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    
    // public function test_dashboard(): void
    // {
    //     $response = $this->get('/dashboard');
    //     $response->assertStatus(200);
    // }

    // public function test_categories(): void
    // {
    //     $response = $this->get('/categories');
    //     $response->assertStatus(200);
    // }
    
    // public function test_categories_show(): void
    // {
    //     $param = 1;
    //     $response = $this->get('/categories/' . $param . '/show');
    //     $response->assertStatus(200);
    //     $param = -1;
    //     $response = $this->get('/categories/' . $param . '/show');
    //     $response->assertStatus(!200);
    // }

    public function test_category_index_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/categories');

        $response->assertOk();
    }

    public function test_category_show_is_displayed(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        
        $response = $this
            ->actingAs($user)
            ->get('/categories/'.$category->id.'/show/');
        
        $response->assertOk();
    }
    
    public function test_category_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this
            ->actingAs($user)
            ->patch('/categories', [
                'name' => 'doofersmith',
                'icon' => 'fa-bug',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/categories');

        $user->refresh();

        $this->assertSame('doofersmith', $category->name);
        $this->assertSame('fa-bug', $category->icon);
        $this->assertNull($category->parent_id);
    }
}
