<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use App\Controller\Usuario\BaseUsuarioController;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetOneUsuarioController extends BaseUsuarioController {
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $obj = $this->getFindService()->getOne((int) $args['id']);
        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
