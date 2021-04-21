<?php

namespace App\Http\Controllers;

use App\Models\Dropbox;
use App\Models\DropboxLog;
use App\Models\User;
use Illuminate\Http\Request;

class DropboxOperationController extends Controller
{
    // Replace full dropbox with a new empty dropbox
    // Full dropbox weight and empty dropbox weight need to be recorded
    public function store(Dropbox $dropbox, Request $request)
    {
        // Temporary
        $this->authorize('update', $dropbox->station);

        $request->validate([
            'empty_weight' => 'numeric|required',
            'filled_weight' => 'numeric|nullable',
            'timestamp' => 'date|required',
        ]);

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

    // Record current active dropbox weight
    // This action should be executed when the dropbox is not yet full after several weeks
    public function inspect(Dropbox $dropbox, Request $request)
    {
        // Temporary
        $this->authorize('update', $dropbox->station);
        if ($dropbox->active_log_id == null) {
            return abort(400, 'Active dropbox not found');
        }

        $request->validate([
            'filled_weight' => 'numeric|required',
            'timestamp' => 'date|required',
        ]);

        $log = $this->createInspection($dropbox, $request->filled_weight, $request->timestamp, $request->user());

        // Update station last_operation_at to now
        $dropbox->station->update(['last_operation_at' => $request->timestamp]);

        return $log;
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

        // Update parent final_weight, ends_at
        $log->parent->update([
            'final_weight' => $weight,
            'ends_at' => $timestamp,
        ]);

        return $log;
    }
}
