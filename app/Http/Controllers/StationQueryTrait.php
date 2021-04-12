<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

/**
 * Station Query Trait
 */
trait StationQueryTrait
{
    /**
     * Station Query
     *
     * @param \App\Models\Station $station
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Station
     */
    public function stationQuery(Station $station, Request $request)
    {
        if (
            $request->filled('longitude') &&
            $request->filled('latitude') &&
            $request->filled('distance')
        ) {
            $station = $station->withDistance($request->longitude, $request->latitude)->having('distance', '<', $request->distance)->orderBy('distance');
        }

        if ($request->filled('keywords')) {
            $station = $station->where(function ($query) use ($request) {
                $query->orWhere('name', 'like', "%{$request->keywords}%")->orWhere('address', 'like', "%{$request->keywords}%")
                    ->orWhere('description', 'like', "%{$request->keywords}%");
            });
        }

        return $station;
    }
}
