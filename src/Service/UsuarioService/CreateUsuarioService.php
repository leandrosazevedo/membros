<?php

declare(strict_types=1);

namespace App\Service\UsuarioService;

use App\Exception\UsuarioException;
use App\Model\Usuario;
use App\Service\UsuarioService\BaseUsuarioService;

final class CreateUsuarioService extends BaseUsuarioService {
    /**
     * @param array<string> $input
     */
    public function create(array $input): object{
        $data = $this->validadorUsuario($input);
        $obj = $this->repositorio->create($data);
        return $obj->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validadorUsuario(array $input): Usuario {
        $obj = json_decode((string) json_encode($input), false);
        if (!isset($obj->nome)) {
            throw new UsuarioException('O campo "nome" é obrigatório.', 400);
        }
        if (!isset($obj->email)) {
            throw new UsuarioException('O campo "email" é obrigatório.', 400);
        }
        if (!isset($obj->senha)) {
            throw new UsuarioException('O campo "senha" é obrigatório.', 400);
        }
        $objNovo = new Usuario();
        $objNovo->setNome(self::validadorNome($obj->nome));
        $objNovo->setEmail(self::validadorEmail($obj->email));
        $hash = password_hash($obj->senha, PASSWORD_BCRYPT);
        $objNovo->setSenha($hash);
        $this->repositorio->verificaPorEmail($obj->email);
        return $objNovo;
    }
}
