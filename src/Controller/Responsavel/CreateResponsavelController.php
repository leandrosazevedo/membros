<?php

declare(strict_types=1);
namespace App\Controller\Responsavel;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class CreateResponsavelController extends BaseResponsavelController {
    public function __invoke(
        Request $request,
        Response $response
    ): Response{
        $input = (array) $request->getParsedBody();
        $obj = $this->getCreateService()->create($input);
        return $this->jsonResponse($response, 'success', $obj, 201);
    }
}
