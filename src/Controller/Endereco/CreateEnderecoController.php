<?php

declare(strict_types=1);

namespace App\Controller\Endereco;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class CreateEnderecoController extends BaseEnderecoController {
    public function __invoke(
        Request $request,
        Response $response
    ): Response{
        $input = (array) $request->getParsedBody();
        $obj = $this->getCreateService()->create($input);
        return $this->jsonResponse($response, 'success', $obj, 201);
    }
}
