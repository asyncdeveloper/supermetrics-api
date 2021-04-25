<?php


namespace App\Core;

use App\Controllers\DataController;
use App\Handlers\CustomExceptionHandler;
use Pecee\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{

    public function __construct() {

        require_once INC_ROOT .'/config/helpers.php';

        SimpleRouter::group(['exceptionHandler' => CustomExceptionHandler::class ], function () {
            SimpleRouter::get('/', function () {
                return response()->json([ 'message' => 'Welcome to Supermetrics Rest API ' ]);
            });

            SimpleRouter::group(['prefix' => 'api'], function () {
                SimpleRouter::get('/stats', [ DataController::class, 'index' ]);
            });
        });

        // change default namespace for all routes
        parent::setDefaultNamespace('\App\Controllers');

        // Do initial stuff
        parent::start();
    }
}
