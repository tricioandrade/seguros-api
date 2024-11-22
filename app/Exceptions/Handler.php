<?php

namespace App\Exceptions;

use App\Traits\Common\Http\HttpResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    use HttpResponseTrait;
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Rendering exception response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response|JsonResponse|\Symfony\Component\HttpFoundation\Response|RedirectResponse
     * @throws DatabaseException
     * @throws Throwable
     */
    public function render($request, Throwable $exception): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response|RedirectResponse
    {
        if ($exception instanceof \PDOException)
            return throw new DatabaseException($exception->getMessage());

        return $this->error($exception);
    }
}
