<?php

declare(strict_types=1);
namespace App\Service;

use Exception;
use Respect\Validation\Validator as v;

abstract class BaseService {
    protected const DEFAULT_PER_PAGE_PAGINATION = 10;

    protected static function validadorTelefone(string $telefoneValue): string {
        if (! v::phone()->validate($telefoneValue)) {
            throw new Exception('Telefone inválido', 400);
        }
        return (string) $telefoneValue;
    }

    protected static function validadorNome(string $nome): string {
        if (strlen($nome) <= 3) {
            throw new Exception('Nome deve possui mais que 3 caracteres', 400);
        }
        return $nome;
    }
}