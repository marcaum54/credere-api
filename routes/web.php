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

$router->get('/', function () use ($router) {
    return 'Credere Sonda API: Online';
});

$router->get('/resetar', 'SondaController@resetar');
$router->get('/executar-comandos', 'SondaController@executarComandos');
$router->get('/posicao-atual', 'SondaController@posicaoAtual');
