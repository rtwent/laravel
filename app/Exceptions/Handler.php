<?php

namespace App\Exceptions;

use App\Dto\ErrorDto;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

//        $this->renderable(function (Throwable $e, $request) {
//            return response()->json([
//                'error' => $e->getMessage(),
//                'trace' => $e->getTraceAsString()
//            ]);
//        });

        $this->renderable(function (Throwable $e, $request) {
            $statusCodeMap = [
                AuthenticationException::class => Response::HTTP_UNAUTHORIZED,
                Unauthorized::class => Response::HTTP_UNAUTHORIZED,
            ];

            $status = Response::HTTP_SERVICE_UNAVAILABLE;
            if (isset($statusCodeMap[get_class($e)])) {
                $status = $statusCodeMap[get_class($e)];
            }
            return new JsonResponse(
                new ErrorDto($e->getMessage(),
                    $status,
                    $e->getTraceAsString() // must be removed in prod mode
                ),
                $status
            );
        });
    }
}
