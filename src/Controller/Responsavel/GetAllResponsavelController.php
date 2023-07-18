<?php

declare(strict_types=1);

namespace App\Controller\Responsavel;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetAllResponsavelController extends BaseResponsavelController {
    public function __invoke(Request $request, Response $response): Response {
        $queryParams = $request->getQueryParams();
        $paginaCorrente = $queryParams['paginaCorrente'] ?? null;
        $porPagina = $queryParams['porPagina'] ?? null;
        $nome = $queryParams['nome'] ?? null;
        $telefone = $queryParams['telefone'] ?? null;

        $obj = $this->getFindService()
            ->getPorPagina((int) $paginaCorrente, (int) $porPagina, $nome, $telefone);

        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
