<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class DefaultController extends BaseController {
    private const API_VERSION = '2.19.0';

    protected function setRespositorio(){
        //$this->repositorio = new repository($this->container->get('db'));
    }

    public function getHelp(Request $request, Response $response): Response {
        $url = $this->container->get('settings')['app']['domain'];
        $endpoints = [
            'usuario' => $url . '/api/v1/usuario',
            'status' => $url . '/status',
            'this help' => $url . '',
        ];
        $message = [
            'endpoints' => $endpoints,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];
        return $this->jsonResponse($response, 'successo', $message, 200);
    }

    public function getStatus(Request $request, Response $response): Response {
        $status = [
            'stats' => $this->getDbStats(),
            'MySQL' => 'OK',
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $status, 200);
    }

    /**
     * @return array<int>
     */
    private function getDbStats(): array {
        $usuarioService = $this->container->get('find_usuario_service');
        return [
            'usuarios' => count($usuarioService->getAll()),
        ];
    }
}
