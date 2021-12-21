<?php

namespace App\Modules\Website\Database\factories;

use App\Modules\Website\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

class WebsiteFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Website::class;

  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->unique()->domainName
    ];
  }
}
