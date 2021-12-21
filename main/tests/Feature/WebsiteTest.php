<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Post\Models\Post;
use App\Modules\Website\Models\Website;

class WebsiteTest extends TestCase
{
  /**
   * A basic test example.
   *
   * @return void
   */
  public function test_user_can_subscribe_to_website()
  {
    $website = Website::factory()->create();
    $email = 'sample@example.com';

    $this->assertDatabaseCount('subscriber_website', 0);

    $this->post(route('websites.subscribe', $website), [
      'email' => $email
    ])
    ->assertSessionHasNoErrors()
    ->assertStatus(201);

    $this->assertDatabaseCount('subscriber_website', 1);

    $this->assertEquals($website->subscribers()->first()->email, $email);
  }
}
