<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;
use App\Traits\ApiResponser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
            // logger('reportable');
        });
        $this->renderable(function(Exception $e, $request) {
            // logger('renderable');
            if ($request->is('api/*')) {
                return $this->handleApiException($request, $e);
            }
        });
    }

    public function handleApiException($request, Exception $exception)
    {
        if($exception instanceof ValidationException) {
            $errors = $exception->validator->getMessages();
            return $this->errorResponse($exception->getMessage(), $errors, $exception->status);
        }

        return $this->errorResponse($exception->getMessage());
    }
    
}
