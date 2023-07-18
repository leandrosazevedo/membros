<?php

declare(strict_types=1);

namespace App\Service\ResponsavelService;

use App\Exception\ResponsavelException;
use App\Model\Responsavel;
use App\Service\ResponsavelService\BaseResponsavelService;

final class CreateResponsavelService extends BaseResponsavelService {

    /**
     * @param array<string> $input
     */
    public function create(array $input): object{
        $data = $this->validador($input);
        $obj = $this->repositorio->create($data);
        return $obj->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validador(array $input): Responsavel {
        $obj = json_decode((string) json_encode($input), false);
        if (!isset($obj->nome)) {
            throw new ResponsavelException('O campo "nome" é obrigatório.', 400);
        }
        if (!isset($obj->telefone)) {
            throw new ResponsavelException('O campo "telefone" é obrigatório.', 400);
        }
        $objNovo = new Responsavel();
        $objNovo->setNome(self::validadorNome($obj->nome));
        $objNovo->setTelefone($obj->telefone);
        $this->repositorio->verificaResponsavelPorTelefone($obj->telefone);
        return $objNovo;
    }

}