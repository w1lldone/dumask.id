<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropbox extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static public $availableModels = ['circle_hole', 'rectangle_hole'];
    static public $availableColors = ['yellow', 'green'];

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }
}
