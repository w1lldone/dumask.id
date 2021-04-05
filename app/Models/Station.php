<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Station extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $withCount = ['dropboxes'];
    protected $with = ['schedules'];

    public function dropboxes()
    {
        return $this->hasMany('App\Models\Dropbox');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule');
    }

    /**
     * Scope a query to include distance of the given coordincates
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $long
     * @param string $lat
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithDistance($query, $longitude, $latitude)
    {
        return $query->addSelect(['distance' => function ($q) use ($latitude, $longitude)
        {
            $q->selectRaw("6371 * ACOS(COS(RADIANS({$latitude}))
                                * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS({$longitude}))
                                + SIN(RADIANS({$latitude})) * SIN(RADIANS(latitude))) AS distance");
        }]);
    }
}
