<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\InvalidOrderException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    protected function getMessageByHttpError($ststusError){
        $msg = "Error desconocido";
        switch ($ststusError){
            case 401:
                $msg = "No esta autorizado para ver este contenido.";
                break;
            case 403:
                $msg = "Prohibido el acceso.";
                break;
            case 404:
                $msg = "Contenido no encontrado.";
                break;
            case 419:
                $msg = "Tu sesión ha expirado.";
                break;
            case 429:
                $msg = "Se han recibido demasiados parámetros.";
                break;
            case 500:
                $msg = "Error interno en los servidores. Intente más tarde.";
                break;
            case 503:
                $msg = "Servidor no disponible.";
                break;

        }
        return $msg;
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(){

        $this->renderable(function (HttpException $e, $request) {
            //dd($e);
            Auth::logout();
            return response()->view('errors.errors_page', [
                'code'=>$e->getStatusCode(),
                'mensaje' => $this->getMessageByHttpError($e->getStatusCode())
            ]);
        });
    }

}
