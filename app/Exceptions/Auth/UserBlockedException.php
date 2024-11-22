<?php

namespace App\Exceptions\Auth;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UserBlockedException extends Exception
{
    use HttpResponseTrait;

    protected $message = 'You are blocked';

    /**
     * Return error response
     *
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this);
    }
}
