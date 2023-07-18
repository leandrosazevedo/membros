<?php

declare(strict_types=1);

use App\Controller\Responsavel\CreateResponsavelController;
use App\Controller\Responsavel\GetAllResponsavelController;
use App\Controller\Responsavel\GetOneResponsavelController;
use App\Controller\Responsavel\UpdateResponsavelController;
use App\Middleware\Auth;
use Slim\Routing\RouteCollectorProxy;
use App\Controller\Usuario\LoginUsuarioController;
use App\Controller\Usuario\GetOneUsuarioController;
use App\Controller\Usuario\GetAllUsuarioController;
use App\Controller\Usuario\CreateUsuarioController;
use App\Controller\Usuario\DeleteResponsavelController;
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

$app->group('/responsavel', function (RouteCollectorProxy $group): void {
    $group->post('', CreateResponsavelController::class)->add(new Auth());
    $group->get('', GetAllResponsavelController::class)->add(new Auth());
    $group->get('/{id}', GetOneResponsavelController::class)->add(new Auth());
    $group->put('/{id}', UpdateResponsavelController::class)->add(new Auth());
    $group->delete('/{id}', DeleteResponsavelController::class)->add(new Auth());
});