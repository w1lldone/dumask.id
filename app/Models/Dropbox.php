<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropbox extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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
}
