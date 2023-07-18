<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class LoginUsuarioController extends BaseUsuarioController {
    public function __invoke(Request $request, Response $response): Response{
        $input = (array) $request->getParsedBody();
        $jwt = $this->getLoginService()->login($input);
        $message = [
            'Authorization' => 'Bearer ' . $jwt,
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }
}
