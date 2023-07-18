<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetAllUsuarioController extends BaseUsuarioController {
    public function __invoke(Request $request, Response $response): Response {
        $queryParams = $request->getQueryParams();
        $paginaCorrente = $queryParams['paginaCorrente'] ?? null;
        $porPagina = $queryParams['porPagina'] ?? null;
        $nome = $queryParams['nome'] ?? null;
        $email = $queryParams['email'] ?? null;

        $obj = $this->getFindService()
            ->getPorPagina((int) $paginaCorrente, (int) $porPagina, $nome, $email);

        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
