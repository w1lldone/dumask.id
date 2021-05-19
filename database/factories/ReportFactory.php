<?php

namespace Database\Factories;

use App\Models\Report;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'station_id' => Station::factory(),
            'reporter_id' => User::factory(),
            'user_latitude' => $this->faker->latitude,
            'user_longitude' => $this->faker->longitude,
            'condition' => $this->faker->randomElement(Report::getConditions()),
            'resolved_at' => null,
            'resolver_id' => null,
        ];
    }
}
