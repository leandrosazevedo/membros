<?php

declare(strict_types=1);

namespace App\Controller\Endereco;

use App\Controller\Endereco\BaseEnderecoController;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetOneEnderecoController extends BaseEnderecoController {
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $obj = $this->getFindService()->getPorId((int) $args['id']);
        return $this->jsonResponse($response, 'success', $obj->toJson(), 200);
    }
}
