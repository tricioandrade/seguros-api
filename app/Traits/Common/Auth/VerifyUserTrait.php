<?php

namespace App\Traits\Common\Auth;

trait VerifyUserTrait
{
    public function isAdmin()
    {
        return true;
//        return auth()->user()->is_admin;
    }

    public function isClient()
    {
        return true;
//        return auth()->user()->is_client;
    }

    public function isBlocked()
    {
        return true;
//        return auth()->user()->is_blocked;
    }
}
