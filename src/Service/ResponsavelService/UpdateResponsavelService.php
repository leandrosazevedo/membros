<?php

declare(strict_types=1);
namespace App\Service\ResponsavelService;

use App\Exception\ResponsavelException as ResponsavelException;
use App\Model\Responsavel;
use App\Service\ResponsavelService\BaseResponsavelService;

final class UpdateResponsavelService extends BaseResponsavelService {
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $id): object {
        $data = $this->validadorData($input, $id);
        $user = $this->repositorio->update($data);
        return $user->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validadorData(array $input, int $id): Responsavel {
        $obj = $this->repositorio->getPorId($id);
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->nome) && ! isset($data->telefone)) {
            throw new ResponsavelException('Insira os dados para atualizar o responsável.', 400);
        }
        if (isset($data->nome)) {
            $obj->setNome(self::validadorNome($data->nome));
        }
        $obj->setTelefone($data->telefone);
        return $obj;
    }
}
