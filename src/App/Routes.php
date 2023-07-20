<?php

declare(strict_types=1);

use App\Controller\Endereco\CreateEnderecoController;
use App\Controller\Endereco\GetAllEnderecoController;
use App\Controller\Endereco\GetOneEnderecoController;
use App\Controller\Endereco\UpdateEnderecoController;
use App\Middleware\Auth;
use Slim\Routing\RouteCollectorProxy;
use App\Controller\Usuario\LoginUsuarioController;
use App\Controller\Usuario\GetOneUsuarioController;
use App\Controller\Usuario\GetAllUsuarioController;
use App\Controller\Usuario\CreateUsuarioController;
use App\Controller\Usuario\DeleteEnderecoController;
use App\Controller\Usuario\UpdateUsuarioController;
use App\Controller\Usuario\DeleteUsuarioController;

$app->get('/', 'App\Controller\Home\HomeController:getHelp');
$app->get('/status', 'App\Controller\Home\HomeController:getStatus');

$app->post('/login', LoginUsuarioController::class);

$app->group('/usuario', function (RouteCollectorProxy $group): void {
    $group->post('', CreateUsuarioController::class);
    $group->get('', GetAllUsuarioController::class)->add(new Auth());
    $group->get('/{id}', GetOneUsuarioController::class)->add(new Auth());
    $group->put('/{id}', UpdateUsuarioController::class)->add(new Auth());
    $group->delete('/{id}', DeleteUsuarioController::class)->add(new Auth());
});

$app->group('/endereco', function (RouteCollectorProxy $group): void {
    $group->post('', CreateEnderecoController::class)->add(new Auth());
    $group->get('', GetAllEnderecoController::class)->add(new Auth());
    $group->get('/{id}', GetOneEnderecoController::class)->add(new Auth());
    $group->put('/{id}', UpdateEnderecoController::class)->add(new Auth());
    $group->delete('/{id}', DeleteEnderecoController::class)->add(new Auth());
});