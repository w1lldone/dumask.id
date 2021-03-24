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

        if ($request->filled('longitude') && $request->filled('latitude')) {
            $station = $station->withDistance($request->longitude, $request->latitude)->having('distance', '<', 15)->orderBy('distance');
        }

        if ($request->filled('keywords')) {
            $station = $station->where(function ($query) use ($request)
            {
                $query->orWhere('name', 'like', "%{$request->keywords}%")->orWhere('address', 'like', "%{$request->keywords}%")
                ->orWhere('description', 'like', "%{$request->keywords}%");
            });
        }

        $stations = $station->paginate();

        return $stations;
    }
}
