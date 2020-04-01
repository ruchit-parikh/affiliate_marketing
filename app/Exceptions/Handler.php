<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException || $preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                try {
                    $new_token = JWTAuth::refresh($request->header('Authorization'));
                    return jsonResponse('error', __('auth.token_refreshed'), [
                        'token' => $new_token
                    ]);
                } catch (JWTException $e) {
                    return jsonResponse('error', __('auth.token_expired'), [], 401);
                }
            } else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return jsonResponse('error', __('auth.token_invalid'), [], 401);
            }
        }

        if ($exception->getMessage() === 'Token not provided') {
            return jsonResponse('error', __('auth.token_not_provided'), [], 404);
        }
        return parent::render($request, $exception);
    }
}
