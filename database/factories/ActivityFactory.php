<?php

namespace Database\Factories;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $is_free = rand(0,1);
        $price = $is_free? null : rand(200,1200);

        $is_everday = rand(0,1);
        $frequency_note = $is_everday? $this->faker->word .' '. $this->faker->word : null;

        return [
            'city_id' => 1,
            'title' => $this->faker->word . ' Activity',
            'description' => $this->faker->text(rand(200,400)),
            'lat' => $this->faker->latitude(42, 46),
            'lng' => $this->faker->longitude(19, 22),
            'is_free' => $is_free,
            'price' => $price,
            'is_active' => [1,1,1,1,0][rand(0,4)],
        ];
    }
}
