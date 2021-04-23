<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'default_password'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions' => 'json'
    ];

    public static $permissions = [
        'manage users',
        'manage stations',
        'operate stations'
    ];

    public function hasPermission($permission)
    {
        if ($permission == null || !$this->permissions) {
            return false;
        }

        return in_array($permission, $this->permissions);
    }

    /**
     * Users does not have password when they registered via Google
     *
     * @return bool
     */
    public function getHasNoPasswordAttribute()
    {
        if ($this->google_id == null) {
            return false;
        }

        if ($this->password == $this->default_password) {
            return true;
        }

        return false;
    }
}
