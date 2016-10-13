<?php

namespace Leandreaci\LaravelPermission;

use Illuminate\Contracts\Auth\Guard;

class LaravelPermission
{
    /**
     * @var Illuminate\Contracts\Auth\Guard
     */
    protected $auth;
    /**
     * Create a new UserHasPermission instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Checks if user has the given permissions.
     *
     * @param array|string $permissions
     *
     * @return bool
     */
    public function can($permissions,$arguments = [])
    {
        if ($this->auth->check()) {
            return $this->auth->user()->can($permissions);
        }

        return false;
    }

    public function cant($permissions,$arguments = [])
    {
        return ! $this->can($permissions,$arguments = []);
    }

}