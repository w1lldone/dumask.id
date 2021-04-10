<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationMediaResource;
use App\Models\Station;
use Illuminate\Http\Request;

class StationMediaController extends Controller
{
    public function index(Station $station)
    {
        return StationMediaResource::collection($station->media);
    }

    public function store(Station $station, Request $request)
    {
        $this->authorize('update', $station);
        
        $data = $request->validate([
            'media' => 'file|required|image'
        ]);
        
        $media = $station->addMediaFromRequest('media')->toMediaCollection('images');

        return new StationMediaResource($media);
    }

    public function destroy(Station $station, $media)
    {
        $this->authorize('update', $station);

        $station->media()->findOrFail($media)->delete();

        return response()->noContent();
    }
}
