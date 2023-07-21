<?php

declare(strict_types=1);
namespace App\Service\IgrejaService;

final class DeleteIgrejaService extends BaseIgrejaService {
    public function delete(int $id): void {
        $this->repositorio->delete($id);
    }
}