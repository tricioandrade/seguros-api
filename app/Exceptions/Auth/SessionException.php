<?php

namespace App\Exceptions\Auth;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SessionException extends Exception
{
    use HttpResponseTrait;
    protected $message = 'Sorry, can\'t get you logged!';

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this, Response::HTTP_UNAUTHORIZED);
    }
}
