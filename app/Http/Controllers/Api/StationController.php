<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index(Request $request)
    {
        $station = new Station();

        $stations = $station->paginate();

        return $stations;
    }
}
