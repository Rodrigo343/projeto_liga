<?php

use App\Controllers\AuthController;
use App\Controllers\CartaController;
use App\Controllers\EdicaoCartaController;
use App\Middlewares\JwtMiddleware;

use function src\{
    jwtAuth
};


use function src\{
    slimConfiguration
};

$app = new \Slim\App(slimConfiguration());

$app->post('/login', AuthController::class . ':login');
$app->delete('/logout', AuthController::class . ':logout');
$app->get('/listaCartas', CartaController::class . ':listaCartas');

$app->group('/v1', function() use ($app)
{
    $app->group('/grupo_edicao_cartas', function() use ($app)
    {
        $app->post('/inserir', EdicaoCartaController::class . ':adicionaEdicao');
        $app->put('/editar', EdicaoCartaController::class . ':atualizaEdicao');
        $app->delete('/inativar', EdicaoCartaController::class . ':inativaEdicao');
    });

    $app->group('/grupo_cartas', function() use ($app)
    {
        $app->post('/inserir', CartaController::class . ':adicionaCarta');
        $app->put('/editar', CartaController::class . ':atualizaCarta');
        $app->delete('/inativar', CartaController::class . ':inativaCarta');
    });
 
})->add((new JwtMiddleware()))
    ->add(jwtAuth());

$app->run();

?>