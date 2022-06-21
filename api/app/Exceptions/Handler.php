<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [

    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    public function render($request, Throwable $exception): Response
    {
        if ($exception instanceof BaseException) {
            return new JsonResponse(
                [
                    'error' => [
                        'message' => $exception->getMessage(),
                        'code' => $exception->getCode(),
                    ],
                ],
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        return new JsonResponse([
                                    'error' => [
                                        'message' => $exception->getMessage(),
                                    ],
                                ], JsonResponse::HTTP_UNAUTHORIZED);
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return new JsonResponse([
                                    'error' => [
                                        'message' => $exception->getMessage(),
                                        'validator' => $exception->errors(),
                                    ],
                                ], $exception->status);
    }
}
