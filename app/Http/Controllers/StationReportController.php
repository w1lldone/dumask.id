<?php

namespace App\Http\Controllers;

use App\Http\Resources\StationMediaResource;
use App\Models\Report;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StationReportController extends Controller
{
    public function index(Station $station, Request $request)
    {
        $this->authorize('viewReport', $station);

        $report = $station->reports();

        if ($request->show_all == false) {
            $report = $report->whereNull('resolved_at');
        }

        $reports = $report->get();

        return $reports;
    }

    public function create(Station $station)
    {
       // return Report::getConditions();
        return view('reports.create', compact('station'));
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

    public function resolve(Station $station, Request $request)
    {
        $this->authorize('resolveReport', $station);

        $request->validate([
            'resolve_all' => 'boolean',
            'report_id' => 'array|required_unless:resolve_all,true',
            'report_id.*' => 'integer',
        ]);

        $report = $station->reports();

        if ($request->resolve_all == true) {
            $report = $report->whereNull('resolved_at');
        } else {
            $report = $report->whereIn('id', $request->report_id);
        }

        $report->update([
            'resolved_at' => now(),
            'resolver_id' => $request->user()->id,
        ]);

        return response([
            'success' => true
        ]);
    }
}
