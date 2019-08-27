<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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
       $response = $this->HandleException($request, $exception);

        //app(CorsService::class)->addActualRequestHeaders($response,$request);

        return $response;
    }

    // funcion para generar respuestas para la API
    public function HandleException ($request, Exception $exception)
    {
        if ($exception instanceof ValidationException)
        {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        
        // if ($exception instanceof AuthenticationException)
        // {
        //     return $this->unauthenticated($request, $exception);
        // }

        if ($exception instanceof ModelNotFoundException) 
        {
            $modelName =  class_basename($exception->getModel());

            return $this->errorResponse("no existe la instancia especificada of { $modelName }con el id",404);
        }

        if ($exception instanceof NotFoundHttpException) 
        {
            return $this->errorResponse('Does not exists any endpoint for this URL',$exception->getStatusCode());
        }

        if ($exception instanceof MethodNotAllowedHttpException) 
        {
            return $this->errorResponse('HTTP method does not match with any endpoint',$exception->getStatusCode());
        }

        if ($exception instanceof HttpException) 
        {
            return $this->errorsResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        return $this->errorsResponse('Unexpected error', 500);

    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        
        /*if ($this->isFrontend($request))
        {
            return redirect()->guest(route('login'));
        }

        //if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.','code'=> 401], 401);
        //}*/

        
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();

        return $this->errorResponse($errors, 422);
    }

    //metodo que determina cuando una peticion proviene de HTML y cuando no
    private function isFrontend($request)
    { ///       capta HTML                  verifica que el middleware es el de web o no
        //return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');

    }
}
