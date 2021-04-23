<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropboxLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    static public $availableActivities = ['replacement', 'deployment', 'inspection'];

    public function station()
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
