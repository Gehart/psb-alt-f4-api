<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Http\Controllers\CreditProgramController;
use App\Http\Middleware\ResponseMiddleware;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => [ResponseMiddleware::class]], static function () use ($router) {
    $router->get('/health-check', CreditProgramController::class . '@check');

    $router->get('/credit-program', CreditProgramController::class . '@getCreditProgramByName');
});
