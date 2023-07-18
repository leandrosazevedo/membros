<?php

declare(strict_types=1);
namespace App\Service\UsuarioService;

use App\Exception\UsuarioException as UsuarioException;
use App\Model\Usuario;
use App\Service\UsuarioService\BaseUsuarioService;

final class UpdateUsuarioService extends BaseUsuarioService {
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $id): object {
        $data = $this->validadorData($input, $id);
        $obj = $this->repositorio->update($data);
        return $obj->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validadorData(array $input, int $id): Usuario {
        $obj = $this->repositorio->getPorId($id);
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->nome) && ! isset($data->email)) {
            throw new UsuarioException('Insira os dados para atualizar o usuário.', 400);
        }
        if (isset($data->nome)) {
            $obj->setNome(self::validadorNome($data->nome));
        }
        if (isset($data->email) && $data->email !== $obj->getEmail()) {
            $this->repositorio->verificaPorEmail($data->email);
            $obj->setEmail(self::validadorEmail($data->email));
        }
        return $obj;
    }
}
