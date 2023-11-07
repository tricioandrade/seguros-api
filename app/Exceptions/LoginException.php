<?php

namespace App\Exceptions;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginException extends Exception
{
    use HttpResponseTrait;

    protected $message = 'You must be logged first';

    /**
     * Error response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this, Response::HTTP_UNAUTHORIZED);
    }
}
