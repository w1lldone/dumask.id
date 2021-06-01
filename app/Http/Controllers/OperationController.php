<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dropbox;
use App\Models\DropboxLog;
use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OperationController extends Controller
{
    use StationQueryTrait;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Station::class);

        $station = new Station;

        $station = $this->stationQuery($station, $request)->with(['dropboxes.activeLog'])->withCount([
            'reports' => function ($report) {
                $report->whereNull('resolved_at');
            }
        ]);

        $sort = $this->sortIsAllowed($request->sort) ? $request->sort : array_keys(Station::$sorts)[0];
        $orderBy = explode(".", $sort);

        $stations = $station->orderBy($orderBy[0], $orderBy[1])->paginate(5);

        return view('operation.index', compact('stations', 'sort'));
    }

    /**
     * Determine wheater the sort parameter is alllowed
     *
     * @param string $sort
     * @return bool
     */
    protected function sortIsAllowed(string $sort = null)
    {
        if (!$sort) {
            return false;
        }

        return key_exists($sort, Station::$sorts);
    }

    public function replace(Station $station, Request $request)
    {
        // Temporary
        $this->authorize('update', $station);

        $request->validate([
            'dropbox_id' => ['required', Rule::exists('dropboxes', 'id')->where('station_id', $station->id)],
            'empty_weight' => 'numeric|required',
            'filled_weight' => 'numeric|nullable',
            'timestamp' => 'date|required',
        ]);

        $dropbox = $station->dropboxes()->find($request->dropbox_id);

        if ($request->filled('filled_weight') && $dropbox->active_log_id) {
            $this->createInspection($dropbox, $request->filled_weight, $request->timestamp, $request->user());
        }

        // Create a replacement dropbox log
        // When a dropboxLog created, the related dropbox active_log_id will be automatically updated
        $log = $dropbox->dropboxLogs()->create([
            'activity' => 'replacement',
            'weight' => $request->empty_weight,
            'starts_at' => $request->timestamp,
            'user_id' => $request->user()->id
        ]);

        // Update station last_operation_at to now
        $dropbox->station->update(['last_operation_at' => $request->timestamp]);

        return $log;
    }

    public function show(Station $station)
    {
        $this->authorize('view', $station);

        $dropboxes = $station->dropboxes()->with(['dropboxLogs' => function ($query) {
            $query->orderBy('starts_at')->whereNull('parent_id')->with(['user', 'children' => function ($children)
            {
                $children->with('user')->orderBy('ends_at', 'asc');
            }]);
        }])->get();

        // Uncomment line below to see dropboxes data structure
        // return $dropboxes;

        return view('operation.show', compact('dropboxes', 'station'));
    }

    public function inspect(Station $station, Request $request)
    {
        // Temporary
        $this->authorize('update', $station);

        $request->validate([
            'dropbox_id' => ['required', Rule::exists('dropboxes', 'id')->where('station_id', $station->id)->whereNotNull('active_log_id')],
            'filled_weight' => 'numeric|required',
            'timestamp' => 'date|required',
        ]);

        $dropbox = $station->dropboxes()->find($request->dropbox_id);

        $log = $this->createInspection($dropbox, $request->filled_weight, $request->timestamp, $request->user());

        // Update station last_operation_at to now
        $dropbox->station->update(['last_operation_at' => $request->timestamp]);

        return $log;
    }

    public function destroy(DropboxLog $dropboxLog)
    {
        $dropboxLog->load('dropbox.station');

        $this->authorize('update', $dropboxLog->dropbox->station);

        $dropboxLog->delete();

        return response()->noContent();
    }

    /**
     * Create a inspection typed log
     *
     * @param Dropbox $dropbox
     * @param $weight
     * @param $timestamp
     * @return DropboxLog
     */
    protected function createInspection(Dropbox $dropbox, $weight, $timestamp, User $user)
    {
        // Create a new dropbox log with parent_id = $dropbox->active_log_id, type = inspection
        $log = $dropbox->dropboxLogs()->create([
            'activity' => 'inspection',
            'final_weight' => $weight,
            'ends_at' => $timestamp,
            'parent_id' => $dropbox->active_log_id,
            'user_id' => $user->id
        ]);

        return $log;
    }
}
