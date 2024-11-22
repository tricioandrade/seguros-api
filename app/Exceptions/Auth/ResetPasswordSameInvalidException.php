<?php

namespace App\Exceptions\Auth;

use Exception;

class ResetPasswordSameInvalidException extends Exception
{
    protected $message = 'New Password is same the old password';

    public function render()
    {
        return response()->json([
            'error'   => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}
