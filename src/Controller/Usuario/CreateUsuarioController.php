<?php

declare(strict_types=1);
namespace App\Controller\Usuario;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class CreateUsuarioController extends BaseUsuarioController {
    public function __invoke(Request $request, Response $response): Response{
        $input = (array) $request->getParsedBody();
        $obj = $this->getCreateService()->create($input);

        return $this->jsonResponse($response, 'success', $obj, 201);
    }
}
