<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use App\Controller\Usuario\BaseUsuarioController;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class DeleteUsuarioController extends BaseUsuarioController {
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $usuarioLogadoId = $this->getUsuarioLogadoId($input);
        $id = (int) $args['id'];
        $this->verificaPermissaoUsuarioLogado($id, $usuarioLogadoId);
        $this->getDeleteService()->delete($id);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}
