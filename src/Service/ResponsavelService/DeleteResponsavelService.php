<?php

declare(strict_types=1);
namespace App\Service\ResponsavelService;

final class DeleteResponsavelService extends BaseResponsavelService {
    public function delete(int $id): void {
        $this->getResponsavelPorId($id);
        $this->repositorio->delete($id);
    }
}