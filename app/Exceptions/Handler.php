<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //TokenMismatchException
        if ($e instanceof TokenMismatchException){
            return redirect($request->fullUrl())->with('csrf_error',"Opps! Seems you couldn't submit form for a longtime. Please try again");
        }

        //ModelNotFoundException
        if ($e instanceof ModelNotFoundException) {
            #$e = new NotFoundHttpException($e->getMessage(), $e);
            return response()->view('errors.missing', [], 404);
        }

        //isHttpException
        if ($this->isHttpException($e))
        {
            if($e instanceof NotFoundHttpException)
            {
                return response()->view('errors.missing', [], 404);
            }
            return $this->renderHttpException($e);
        }

        //redirect
        return parent::render($request, $e);
    }
}
