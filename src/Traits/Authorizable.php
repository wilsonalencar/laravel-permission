<?php

namespace Leandreaci\LaravelPermission\Traits;

use App\User;
use Leandreaci\LaravelPermission\Model\Permission;

trait Authorizable
{

    /*
    |----------------------------------------------------------------------
    | Permission Trait Methods
    |----------------------------------------------------------------------
    |
    */

    /**
     * Check if user has the given permission.
     *
     * @param  string $permission
     * @param array $arguments
     * @return bool
     */
    public function can($permission,$arguments = [])
    {
        $permission = Permission::whereHas('users', function ($query) {
            $query->where('id',$this->id);
        })->where('slug',$permission)
            ->first();

        return ($permission) ? true : false;
    }

    public function permissions()
    {
        return $this->belongsToMany(User::class);
    }
}