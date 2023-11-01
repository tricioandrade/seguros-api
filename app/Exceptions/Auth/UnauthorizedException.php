<?php

namespace App\Exceptions\Auth;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class UnauthorizedException extends Exception
{
    use HttpResponseTrait;

    /**
     * Handle http error response
     *
     * @return JsonResponse
     */
    public function handle(): JsonResponse
    {
        return $this->error($this);
    }
}
