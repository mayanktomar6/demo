<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;
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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        //it is custom added for handle wrong route calling
        if ($exception instanceof NotFoundHttpException){
            if ($request->is('api/*'))
                return response()->json(['status'=>404,'message' => 'Resource not found']);
            else
                return response()->view( "errors.404", [ 'page_title' => $exception->getStatusCode(), 'code' => $exception->getStatusCode(),'message' => 'Resource not found'], $exception->getStatusCode() );
        }
        if ($exception instanceof MethodNotAllowedHttpException){
            //return response('Method not allowed', 404);
            if ($request->is('api/*'))
                return response()->json(['status'=>404,'message' => 'Method not allowed']);
            else
                return response()->view( "errors.404", [ 'page_title' => $exception->getStatusCode(), 'code' => $exception->getStatusCode(),'message' => 'Method not allowed' ], $exception->getStatusCode() );
        }

        if ($exception instanceof AuthenticationException){
            if ($request->is('api/*'))
                return response()->json(['status'=>403,'message' => 'Unauthorized']);
            else
                return redirect( '/' );
        }
        return parent::render($request, $exception);
    }
}
