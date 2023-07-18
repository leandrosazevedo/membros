<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Exception\AuthException;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

final class Auth extends BaseAuth {

    public function __invoke(
        Request $request,
        RequestHandler $handler
    ): ResponseInterface{
        $jwtHeader = $request->getHeaderLine('Authorization');
        if (!$jwtHeader) {
            throw new AuthException('Token JWT é obrigatório.', 400);
        }
        $jwt = explode('Bearer ', $jwtHeader);
        if (!isset($jwt[1])) {
            throw new AuthException('Token JWT inválido.', 400);
        }
        $decoded = $this->checkToken($jwt[1]);
        $object = (array) $request->getParsedBody();
        $object['decoded'] = $decoded;
        $response = $handler->handle($request->withParsedBody($object));
        return $response;
    }
}
