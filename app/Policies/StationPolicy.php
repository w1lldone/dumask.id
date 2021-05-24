<?php

namespace App\Policies;

use App\Models\Station;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_superadmin) {
            return true;
        }

        if ($user->hasPermission('manage stations')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Station  $station
     * @return mixed
     */
    public function view(User $user, Station $station)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Station  $station
     * @return mixed
     */
    public function update(User $user, Station $station)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Station  $station
     * @return mixed
     */
    public function delete(User $user, Station $station)
    {
        //
    }

    public function viewReport(User $user, Station $station)
    {
        if ($user->hasPermission('manage stations')) {
            return true;
        }

        if ($user->hasPermission('operation stations')) {
            return true;
        }
    }

    public function resolveReport(User $user, Station $station)
    {
        if ($user->hasPermission('manage stations')) {
            return true;
        }

        if ($user->hasPermission('operation stations')) {
            return true;
        }
    }
}
