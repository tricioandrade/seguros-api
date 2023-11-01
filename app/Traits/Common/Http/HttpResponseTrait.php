<?php

namespace App\Traits\Common\Http;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;

trait HttpResponseTrait
{

    /**
     * Return http response error
     *
     * @param Throwable|Exception $exception
     * @param int $code
     * @return JsonResponse
     */
    public function error(Throwable|Exception $exception, int $code = 500): JsonResponse
    {
        return response()->json([
            'message'   => $exception->getMessage(),
            'file'      => $exception->getFile(),
            'line'      => $exception->getLine()
        ], $code);
    }
}
