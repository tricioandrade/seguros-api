<?php

namespace App\Exceptions;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class DatabaseException extends Exception
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
