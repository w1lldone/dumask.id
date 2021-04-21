<?php

namespace App\Http\Controllers\Api;

use App\Models\Station;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\StationQueryTrait;

class StationController extends Controller
{
    use StationQueryTrait;

    public function index(Request $request)
    {
        $station = new Station();

        $station = $this->stationQuery($station, $request);

        $stations = $station->with('schedules')->paginate();

        return $stations;
    }
}
