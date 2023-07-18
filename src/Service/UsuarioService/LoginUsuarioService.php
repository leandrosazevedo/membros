<?php

declare(strict_types=1);

namespace App\Service\UsuarioService;

use App\Exception\UsuarioException;
use App\Service\UsuarioService\BaseUsuarioService;
use Firebase\JWT\JWT;

final class LoginUsuarioService extends BaseUsuarioService {
    /**
     * @param array<string> $input
     */
    public function login(array $input): string {
        $data = json_decode((string) json_encode($input), false);
        if (!isset($data->email)) {
            throw new UsuarioException('O campo "email" é obrigatório.', 400);
        }
        if (!isset($data->senha)) {
            throw new UsuarioException('O campo "senha" é obrigatório.', 400);
        }
        $usuario = $this->repositorio->login($data->email, $data->senha);
        //echo var_dump($usuario);
        $token = [
            'sub' => $usuario->getId(),
            'email' => $usuario->getEmail(),
            'nome' => $usuario->getNome(),
            'iat' => time(),
            'exp' => time() + (2 * 24 * 60 * 60),
        ];
        
        return JWT::encode($token, $_SERVER['SECRET_KEY'],'HS256');
    }
}
