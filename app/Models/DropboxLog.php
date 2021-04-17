<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropboxLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    static public $availableActivities = ['replacement', 'inspection'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Listen to the created event
        static::created(function ($dropboxLog) {
            // Automatically update active_log_id on related Dropbox Model
            if ($dropboxLog->activity == 'replacement') {
                $dropboxLog->dropbox->update(['active_log_id' => $dropboxLog->id]);
            }
        });
    }

    public function dropbox()
    {
        return $this->belongsTo('App\Models\Dropbox');
    }

    public function children()
    {
        return $this->hasMany('App\Models\DropboxLog', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\DropboxLog', 'parent_id');
    }
}
