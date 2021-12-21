<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Post\Models\Post;
use App\Modules\Post\Notifications\PostCreatedNotification;
use Illuminate\Support\Facades\Event;
use App\Modules\Website\Models\Website;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{

  public function test_can_create_post()
  {
    // Event::fake();
    // Notification::fake();
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

  public function test_mails_will_be_sent_to_subscribers_on_create_post()
  {
    // Notification::fake();
    $website = Website::factory()->create();

    foreach (['one@example.com', 'two@example.com', 'three@example.com'] as $email) {
      $this->post(route('websites.subscribe', $website), [
        'email' => $email
      ]);
    }

    $this->assertDatabaseCount('posts', 0);
    $this->assertDatabaseCount('subscribers', 3);
    $this->assertDatabaseCount('subscriber_website', 3);

    $this->post(route('posts.create', $website), [
      'title' => $this->faker->sentence,
      'description' => $this->faker->sentences(3, true),
      'content' => $this->faker->sentences(15, true),
    ]);

    /** Discarded in favor of sending via Command */
    // Notification::assertTimesSent(3, PostCreatedNotification::class);
    // $this->assertNotNull(Post::first()->mail_sent_at);
  }

  public function test_mail_sending_command()
  {
    $website = Website::factory()->create();

    $this->assertDatabaseCount('jobs', 0);

    foreach (['one@example.com', 'two@example.com', 'three@example.com'] as $email) {
      $this->post(route('websites.subscribe', $website), [
        'email' => $email
      ]);
    }

    $this->assertDatabaseCount('posts', 0);
    $this->assertDatabaseCount('subscribers', 3);
    $this->assertDatabaseCount('subscriber_website', 3);

    $this->post(route('posts.create', $website), [
      'title' => $this->faker->sentence,
      'description' => $this->faker->sentences(3, true),
      'content' => $this->faker->sentences(15, true),
    ]);

    $this->artisan('new_posts:notify')->assertExitCode(0);

    $this->assertDatabaseCount('jobs', 4);
  }
}
