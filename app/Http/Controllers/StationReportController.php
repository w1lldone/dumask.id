<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationMediaResource;
use App\Models\Report;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StationReportController extends Controller
{
    public function create(Station $station)
    {
        // Submit report view goes here
    }

    public function store(Station $station, Request $request)
    {
        $request->validate([
            'condition' => [Rule::in(Report::getConditions()), 'required'],
            'user_latitude' => 'numeric|between:-90,90|nullable',
            'user_longitude' => 'numeric|between:-180,180|nullable',
            'photo' => 'file|image|nullable',
        ]);

        /** @var Report */
        $report = $station->reports()->create([
            'condition' => $request->condition,
            'user_latitude' => $request->user_latitude,
            'user_longitude' => $request->user_longitude,
            'reporter_id' => $request->user()->id,
        ]);

        if ($request->file('photo')) {
            $report->addMediaFromRequest('photo')->toMediaCollection();
        }

        return $report->load('media')->append('photo')->makeHidden('media');
    }
}
