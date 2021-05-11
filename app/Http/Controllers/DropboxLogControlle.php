<?php

namespace App\Http\Controllers;

use App\Models\DropboxLog;
use Illuminate\Http\Request;

class DropboxLogControlle extends Controller
{
    public function update(DropboxLog $dropboxLog, Request $request)
    {
        $this->authorize('update', $dropboxLog->dropbox->station);

        $data = $request->validate([
            'weight' => 'numeric|nullable',
            'final_weight' => 'numeric|nullable',
            'starts_at' => 'date|nullable',
            'ends_at' => 'date|nullable',
        ]);

        $data['user_id'] = $request->user()->id;

        $dropboxLog->update($data);

        return $dropboxLog;
    }

    public function destroy(DropboxLog $dropboxLog)
    {
        $this->authorize('update', $dropboxLog->dropbox->station);

        $dropboxLog->delete();

        return response()->noContent();
    }
}
