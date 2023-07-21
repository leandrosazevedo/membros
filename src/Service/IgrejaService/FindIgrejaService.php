<?php

declare(strict_types=1);

namespace App\Service\IgrejaService;

final class FindIgrejaService extends BaseIgrejaService {

    /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaCorrente,
        int $porPagina,
        ?string $nome,
        ?string $presidente
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
            $presidente
        );
    }

}
