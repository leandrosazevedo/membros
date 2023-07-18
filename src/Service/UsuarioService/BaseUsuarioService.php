<?php

declare(strict_types=1);
namespace App\Service\UsuarioService;

use App\Model\Usuario;
use App\Repository\UsuarioRepository;
use App\Service\BaseService;
use Respect\Validation\Validator as v;
use App\Exception\UsuarioException;

abstract class BaseUsuarioService extends BaseService{

    public function __construct(
        protected UsuarioRepository $repositorio
    ) { }

    protected static function validadorNome(string $nome): string {
        if (! v::alnum('ÁÉÍÓÚÑáéíóúñ.')->length(1, 100)->validate($nome)) {
            throw new UsuarioException('Nome inválido', 400);
        }
        return $nome;
    }

    protected static function validadorEmail(string $emailValue): string {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (! v::email()->validate($email)) {
            throw new UsuarioException('Email inválido', 400);
        }

        return (string) $email;
    }

}