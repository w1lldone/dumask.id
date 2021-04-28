<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropboxLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['starts_at', 'ends_at'];
    protected $casts = [
        'starts_at' => 'datetime:Y-m-d\TH:i:sP',
        'ends_at' => 'datetime:Y-m-d\TH:i:sP',
    ];
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

        // Listen to the deleted event
        static::deleted(function ($dropboxLog) {
            // If the parent gets deleted, the childern will be deleted too
            if ($dropboxLog->parent_id == null) {
                $dropboxLog->children()->delete();
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
