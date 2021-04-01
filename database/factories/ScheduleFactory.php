<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'station_id' => Station::factory(),
            'day' => $this->faker->randomElement([0, 1, 2, 3, 4, 5, 6]),
            'opened_at' => now()->setTime(7,0),
            'closed_at' => now()->setTime(20,0),
        ];
    }
}
