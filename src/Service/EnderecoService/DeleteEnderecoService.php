<?php

declare(strict_types=1);
namespace App\Service\EnderecoService;

final class DeleteEnderecoService extends BaseEnderecoService {
    public function delete(int $id): void {
        $this->repositorio->delete($id);
    }
}