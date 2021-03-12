<?php

namespace Database\Factories;

use App\Models\Dropbox;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class DropboxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dropbox::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'station_id' => Station::factory(),
            'color' => $this->faker->randomElement(Dropbox::$availableColors),
            'model' => $this->faker->randomElement(Dropbox::$availableModels)
        ];
    }
}
