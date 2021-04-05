<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Station;
use Illuminate\Http\Request;

class StationScheduleController extends Controller
{
    public function index(Station $station)
    {
        return $station->schedules;
    }

    public function store(Station $station, Request $request)
    {
        $this->authorize('update', $station);

        $data = $request->validate([
            'day' => 'numeric|between:0,6|required',
            'opened_at' => 'required_with:closed_at|date_format:H:i',
            'closed_at' => 'required_with:opened_at|date_format:H:i',
        ]);

        $schedule = $station->schedules()->create($data);

        return $schedule;
    }

    public function update(Station $station, $schedule, Request $request)
    {
        $this->authorize('update', $station);

        $data = $request->validate([
            'opened_at' => 'required_with:closed_at|date_format:H:i',
            'closed_at' => 'required_with:opened_at|date_format:H:i',
        ]);

        $schedule = $station->schedules()->findOrFail($schedule);
        $schedule->update($data);

        return $schedule->fresh();
    }

    public function destroy(Station $station, $schedule)
    {
        $this->authorize('update', $station);

        $schedule = $station->schedules()->findOrFail($schedule);

        $schedule->delete();

        return response()->noContent();
    }
}
