<?php

declare(strict_types=1);

namespace App\Controller\Usuario;

use App\Controller\BaseController;
use App\Exception\UsuarioException;
use App\Repository\UsuarioRepository;
use App\Service\UsuarioService\FindUsuarioService;
use App\Service\UsuarioService\LoginUsuarioService;
use App\Service\UsuarioService\CreateUsuarioService;
use App\Service\UsuarioService\DeleteUsuarioService;
use App\Service\UsuarioService\UpdateUsuarioService;

abstract class BaseUsuarioController extends BaseController{
    
    protected function setRespositorio(){
        $this->repositorio = new UsuarioRepository($this->container->get('db'));
    }

    protected function getFindService(): FindUsuarioService {
        return new FindUsuarioService($this->repositorio);
    }

    protected function getLoginService(): LoginUsuarioService {
        return new LoginUsuarioService($this->repositorio);
    }

    protected function getCreateService(): CreateUsuarioService{
        return new CreateUsuarioService($this->repositorio);
    }

    protected function getUpdateService(): UpdateUsuarioService {
        return new UpdateUsuarioService($this->repositorio);
    }

    protected function getDeleteService(): DeleteUsuarioService {
        return new DeleteUsuarioService($this->repositorio);
    }

    protected function verificaPermissaoUsuarioLogado(
        int $idUsuario,
        int $idUsuarioLogado
    ): void {
        if ($idUsuario !== $idUsuarioLogado) {
            throw new UsuarioException('Usuário inválido. Falha na permissão.', 400);
        }
    }

    /**
     * @param array<object> $input
     */
    protected function getUsuarioLogadoId(array $input): int {
        if (isset($input['decoded']) && isset($input['decoded']->sub)) {
            return (int) $input['decoded']->sub;
        }
        throw new UsuarioException('Usuário inválido. Falha na permissão.', 400);
    }

}