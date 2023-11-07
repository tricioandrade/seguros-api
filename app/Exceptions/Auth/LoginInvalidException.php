<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginInvalidException extends Exception
{
    protected $message = 'Invalid login credentials, email or password error!';

    /**
     * Error api response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([
            class_basename($this),
            'message' => $this->getMessage(),
        ], Response::HTTP_FORBIDDEN);
    }
}
