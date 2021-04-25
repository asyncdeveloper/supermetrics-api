<?php


namespace App\Handlers;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

class CustomExceptionHandler implements IExceptionHandler
{

    /**
     * @param Request $request
     * @param \Exception $error
     * @throws \Exception
     */
    public function handleError(Request $request, \Exception $error) : void
    {

        if($error instanceof ModelNotFoundException) {
            response()
              ->httpCode(404)
              ->json([ 'message' => $error->getMessage() ]);
        } else {
            response()
              ->httpCode($error->getCode())
              ->json([ 'message' => $error->getMessage() ]);
        }
    }

}