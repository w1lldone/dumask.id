<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    use StationQueryTrait;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Station::class);
        
        $station = $this->stationQuery(new Station, $request);

        $stations = $station->paginate();

        // this will be replaced with view() response
        return $stations;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Station::class);

        $data = $request->validate([
            'name' => 'required|min:3|max:255|string',
            'address' => 'nullable|string|max:1000|min:3',
            'description' => 'nullable|string|max:1000|min:3',
            'latitude' => 'numeric|between:-90,90|nullable',
            'longitude' => 'numeric|between:-180,180|nullable',
        ]);

        $station = Station::create($data);

        return $station;
    }

    public function show(Station $station)
    {
        $this->authorize('view', $station);
        
        $station->load('dropboxes');

        // this will be replaced with view() response
        return $station;
    }

    public function update(Station $station, Request $request)
    {
        $this->authorize('update', $station);

        $data = $request->validate([
            'name' => 'min:3|max:255|string',
            'address' => 'nullable|string|max:1000|min:3',
            'description' => 'nullable|string|max:1000|min:3',
            'latitude' => 'numeric|between:-90,90|nullable',
            'longitude' => 'numeric|between:-180,180|nullable',
        ]);

        $station->update($data);

        return $station->fresh(); 
    }

    public function destroy(Station $station)
    {
        $this->authorize('delete', $station);

        $station->delete();

        return response()->noContent();
    }
}
