<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use App\Controller\Responsavel\BaseResponsavelController;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class DeleteResponsavelController extends BaseResponsavelController {
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $id = (int) $args['id'];
        $this->getDeleteService()->delete($id);
        return $this->jsonResponse($response, 'success', null, 204);
    }
}
