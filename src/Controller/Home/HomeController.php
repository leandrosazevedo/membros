<?php

declare(strict_types=1);

namespace App\Controller\Home;

use App\CustomResponse as Response;
use Pimple\Psr11\Container;
use Psr\Http\Message\ServerRequestInterface as Request;

final class HomeController {
    private const API_NAME = 'slim4-api';

    private const API_VERSION = '1.0';

    private Container $container;

    public function __construct(Container $container){
        $this->container = $container;
    }

    public function getHelp(Request $request, Response $response): Response {
        $message = [
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($message);
    }

    public function getStatus(Request $request, Response $response): Response {
        $this->container->get('db');
        $status = [
            'status' => [
                'database' => 'OK',
            ],
            'api' => self::API_NAME,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $response->withJson($status);
    }
}
