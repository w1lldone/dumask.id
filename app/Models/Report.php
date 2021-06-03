<?php

namespace App\Models;

use App\Http\Resources\StationMediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Report extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    public static $conditions = [
        'full' => 'Dropbox Penuh',
        'missing' => 'Dropbox Hilang/Tidak Pada Tempatnya',
        'damaged' => 'Dropbox Rusak'
    ];

    protected $guarded = ['id'];
    protected $dates = ['resolved_at'];
    protected $casts = [
        'resolved_at' => 'datetime:Y-m-d\TH:i:sP',
    ];

    public static function getConditions()
    {
        return array_keys(self::$conditions);
    }

    public function station()
    {
        return $this->belongsTo('App\Models\Station');
    }

    public function reporter()
    {
        return $this->belongsTo('App\Models\User', 'reporter_id');
    }

    public function resolver()
    {
        return $this->belongsTo('App\Models\User', 'resolver_id');
    }

    public function getPhotoAttribute()
    {
        if ($media = $this->getFirstMedia()) {
            return new StationMediaResource($media);
        }

        return null;
    }
}
