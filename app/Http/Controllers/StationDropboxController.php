<?php

namespace App\Http\Controllers;

use App\Models\Dropbox;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StationDropboxController extends Controller
{
    public function index(Station $station)
    {
        $dropboxes = $station->dropboxes()->with(['dropboxLogs' => function ($query)
        {
            $query->whereNull('parent_id')->with('children');
        }])->get();

        // Uncomment line below to see dropboxes data structure
        // return $dropboxes;

        return view('station.dropbox', compact('dropboxes', 'station'));
    }

    public function store(Station $station, Request $request)
    {
        $this->authorize('update', $station);

        $data = $request->validate([
            'model' => ['required', 'string', Rule::in(Dropbox::$availableModels)],
            'color' => ['required', 'string', Rule::in(Dropbox::$availableColors)]
        ]);

        $dropbox = $station->dropboxes()->create($data);

        return $dropbox;
    }

    public function update(Request $request, Station $station, $dropbox)
    {
        $this->authorize('update', $station);
        $dropbox = $station->dropboxes()->findOrFail($dropbox);

        $data = $request->validate([
            'model' => ['string', Rule::in(Dropbox::$availableModels)],
            'color' => ['string', Rule::in(Dropbox::$availableColors)]
        ]);

        $dropbox->update($data);

        return $dropbox->fresh();
    }

    public function destroy(Station $station, $dropbox)
    {
        $this->authorize('update', $station);

        $dropbox = $station->dropboxes()->findOrFail($dropbox);

        $dropbox->delete();

        return response()->noContent();
    }
}
