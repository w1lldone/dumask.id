<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

        // Listen to saved event
        static::saved(function ($dropboxLog)
        {
            // Update parent final_weight, ends_at
            if ($dropboxLog->parent_id) {
                $latestLog = $dropboxLog->parent->children()->orderBy('ends_at', 'desc')->first();
                $dropboxLog->parent->update([
                    'final_weight' => $latestLog->final_weight,
                    'ends_at' => $latestLog->ends_at,
                ]);
            }
        });

        // Listen to the deleted event
        static::deleted(function ($dropboxLog) {
            // If the parent gets deleted, the childern will be deleted too
            if ($dropboxLog->parent_id == null) {
                $dropboxLog->children()->delete();
            }

            // Update parent final_weight, ends_at
            if ($dropboxLog->parent_id) {
                $latestLog = $dropboxLog->parent->children()->orderBy('ends_at', 'desc')->first();
                $dropboxLog->parent->update([
                    'final_weight' => optional($latestLog)->final_weight,
                    'ends_at' => optional($latestLog)->ends_at,
                ]);
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

    public static function getTotalWeight()
    {
        return static::selectRaw("final_weight - weight as total_weight")->whereNull('parent_id')->whereNotNull('final_weight')->get()->sum('total_weight');
    }
}
