<?php

namespace App\Exceptions\Auth;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class SessionRequestException extends Exception
{
    use HttpResponseTrait;
    protected $message = 'Already logged';

    /**
     * Return Error response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this);
    }
}
