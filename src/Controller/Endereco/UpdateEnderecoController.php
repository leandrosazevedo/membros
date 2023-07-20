<?php

declare(strict_types=1);
namespace App\Controller\Endereco;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class UpdateEnderecoController extends BaseEnderecoController {
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
        $obj = $this->getUpdateService()->update($input, $id);
        return $this->jsonResponse($response, 'success', $obj, 200);
    }
}
