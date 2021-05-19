<?php


namespace App\Exceptions;

use Exception;

class InvalidOrderException extends Exception{

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request){

        $this->renderable(function (InvalidOrderException $e, $request) {
            dd($e->getMessage());
            return response()->view('errors.errors_page', [], 419);
        });

    }
}
