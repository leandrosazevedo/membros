<?php

declare(strict_types=1);

namespace App\Service\EnderecoService;

final class FindEnderecoService extends BaseEnderecoService {

    /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaCorrente,
        int $porPagina,
        ?string $rua
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
            $rua
        );
    }

}
