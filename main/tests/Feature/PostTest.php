<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Post\Models\Post;
use App\Modules\Website\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
  /**
   * A basic test example.
   *
   * @return void
   */
  public function test_can_create_post()
  {
    $website = Website::factory()->create();

    $this->assertDatabaseCount('posts', 0);

    $this->post(route('posts.create', $website), [
      'title' => $this->faker->sentence,
      'description' => $this->faker->sentences(3, true),
      'content' => $this->faker->sentences(15, true),
    ])
    ->assertSessionHasNoErrors()
    ->assertStatus(201);

    $this->assertDatabaseCount('posts', 1);

    $this->assertTrue(Post::first()->is($website->posts->first()));
  }
}
