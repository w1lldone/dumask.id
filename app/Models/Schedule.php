<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'opened_at' => 'datetime:H:i',
        'closed_at' => 'datetime:H:i',
    ];

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }
}
