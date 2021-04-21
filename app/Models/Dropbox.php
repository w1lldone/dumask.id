<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropbox extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['image_url'];

    static public $availableModels = ['lubang bulat', 'lubang kotak'];
    static public $availableColors = ['kuning', 'hijau'];

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }

    public function dropboxLogs()
    {
        return $this->hasMany('App\Models\DropboxLog');
    }

    public function activeLog()
    {
        return $this->belongsTo('App\Models\DropboxLog', 'active_log_id');
    }

    /**
     * Generate Image Url from dropbox images resources
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        try {
            $fileName = mix("dropboxes/{$this->color}_{$this->model}.jpg")->toHtml();
        } catch (\Throwable $th) {
            $fileName = null;
        }

        return $fileName;
    }
}
