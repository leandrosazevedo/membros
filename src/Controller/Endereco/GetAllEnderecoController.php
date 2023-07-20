<?php

declare(strict_types=1);

namespace App\Controller\Endereco;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetAllEnderecoController extends BaseEnderecoController {
    public function __invoke(Request $request, Response $response): Response {
        $queryParams = $request->getQueryParams();
        $paginaCorrente = $queryParams['paginaCorrente'] ?? null;
        $porPagina = $queryParams['porPagina'] ?? null;
        $rua = $queryParams['rua'] ?? null;

        $obj = $this->getFindService()
            ->getPorPagina((int) $paginaCorrente, (int) $porPagina, $rua);

        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
