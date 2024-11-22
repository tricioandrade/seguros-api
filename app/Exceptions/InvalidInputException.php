<?php

namespace App\Exceptions;

use App\Traits\Common\Http\HttpResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InvalidInputException extends Exception
{
    use HttpResponseTrait;
    protected $message = 'Invalid input';

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this,Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
