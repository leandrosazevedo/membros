<?php

declare(strict_types=1);

namespace App\Service\ResponsavelService;

final class FindResponsavelService extends BaseResponsavelService {
    /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaCorrente,
        int $porPagina,
        ?string $nome,
        ?string $telefone
    ): array {
        if ($paginaCorrente < 1) {
            $paginaCorrente = 1;
        }
        if ($porPagina < 1) {
            $porPagina = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->repositorio->getPorPagina(
            $paginaCorrente,
            $porPagina,
            $nome,
            $telefone
        );
    }

    /**
     * @return array<string>
     */
    public function getTodos(): array {
        return $this->repositorio->getTodos();
    }

    public function getOne(int $id): object {
        return $this->repositorio->getPorId($id)->toJson();
    }
}
