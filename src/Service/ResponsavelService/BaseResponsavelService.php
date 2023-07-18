<?php

declare(strict_types=1);
namespace App\Service\ResponsavelService;

use App\Exception\ResponsavelException;
use App\Service\BaseService;
use Respect\Validation\Validator as v;
use App\Model\Responsavel;
use App\Repository\ResponsavelRepository;

abstract class BaseResponsavelService extends BaseService{

    public function __construct(
        protected ResponsavelRepository $repositorio
    ) { }

    protected static function validadorTelefone(string $telefoneValue): string {
        if (! v::phone()->validate($telefoneValue)) {
            throw new ResponsavelException('Telefone inválido', 400);
        }

        return (string) $telefoneValue;
    }

    protected function getPorId(int $responsavelId): Responsavel {
        return $this->repositorio->getPorId($responsavelId);
    }

    protected static function validadorNome(string $nome): string {
        if (strlen($nome) <= 3) {
            throw new ResponsavelException('Nome deve possui mais que 3 caracteres', 400);
        }
        return $nome;
    }

}