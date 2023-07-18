<?php

declare(strict_types=1);
namespace App\Service\UsuarioService;

final class DeleteUsuarioService extends BaseUsuarioService {
    public function delete(int $id): void {
        $this->repositorio->getPorId($id);
        $this->repositorio->delete($id);
    }
}
