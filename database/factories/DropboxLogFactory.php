<?php

namespace Database\Factories;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class DropboxLogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DropboxLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dropbox_id' => Dropbox::factory(),
            'parent_id' => null,
            'activity' => $this->faker->randomElement(DropboxLog::$availableActivities),
            'weight' => $this->faker->numberBetween(100, 150) / 100,
            'final_weight' => $this->faker->numberBetween(200, 500) / 100,
            'starts_at' => $this->faker->dateTime(),
            'ends_at' => $this->faker->dateTime(),
        ];
    }
}
