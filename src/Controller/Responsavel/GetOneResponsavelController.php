<?php

declare(strict_types=1);

namespace App\Controller\Responsavel;

use App\Controller\Responsavel\BaseResponsavelController;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\CustomResponse as Response;

final class GetOneResponsavelController extends BaseResponsavelController {
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
