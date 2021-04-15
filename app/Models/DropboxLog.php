<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropboxLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function station()
    {
        return $this->belongsTo('App\Models\Dropbox');
    }
}