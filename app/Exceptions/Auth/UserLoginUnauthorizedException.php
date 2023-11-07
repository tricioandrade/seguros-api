<?php

namespace App\Exceptions\Auth;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserLoginUnauthorizedException extends Exception
{
    use HttpResponseTrait;
    protected $message = 'You are not allowed to logged in';

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this,code: Response::HTTP_UNAUTHORIZED);
    }
}
