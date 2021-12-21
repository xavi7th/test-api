<?php

namespace App\Modules\Post\Database\factories;

use App\Modules\Post\Models\Post;
use App\Modules\Website\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Post::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'website_id' => null,
      'title' => $this->faker->unique()->sentence(),
      'description' => $this->faker->sentences(3),
      'content' => $this->faker->sentences(15),
    ];
  }


  public function with_website()
  {
    return $this->state(function (array $attributes) {
      return [
        'website_id' => Website::factory()->create()->id,
      ];
    });
  }
}
