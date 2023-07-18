<?php

declare(strict_types=1);

namespace App\Controller;

use App\CustomResponse as Response;
use App\Repository\BaseRepository;
use Pimple\Psr11\Container;

abstract class BaseController {

    protected Container $container;
    protected BaseRepository $repositorio;

    public function __construct(Container $container) {
        $this->container = $container;
        $this->setRespositorio();
    }

    abstract protected function setRespositorio();
    protected function jsonResponse(
        Response $response,
        string $status,
        $mensagem,
        int $codigo
    ): Response {
        $resultado = [
            'codigo' => $codigo,
            'status' => $status,
            'mensagem' => $mensagem,
        ];
        return $response->withJson($resultado, $codigo, JSON_PRETTY_PRINT);
    }

}
