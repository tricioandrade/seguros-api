<?php

namespace App\Traits\Common\Auth;

trait VerifyUserTrait
{
    public function isAdmin()
    {
        return auth()->user()->is_admin;
    }

    public function isClient()
    {
        return auth()->user()->is_client;
    }

    public function isBlocked()
    {
        return auth()->user()->is_blocked;
    }
}
