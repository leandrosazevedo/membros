<?php

declare(strict_types=1);
namespace App\Controller\Usuario;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class UpdateUsuarioController extends BaseUsuarioController {
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $id = (int) $args['id'];
        $usuarioLogadoId = $this->getUsuarioLogadoId($input);
        $this->verificaPermissaoUsuarioLogado($id, $usuarioLogadoId);
        $obj = $this->getUpdateService()->update($input, $id);
        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
