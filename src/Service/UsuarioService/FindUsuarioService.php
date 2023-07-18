<?php

declare(strict_types=1);

namespace App\Service\UsuarioService;

final class FindUsuarioService extends BaseUsuarioService {
    /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaCorrente,
        int $porPagina,
        ?string $nome,
        ?string $email
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
            $email
        );
    }

    /**
     * @return array<string>
     */
    public function getTodosUsuarios(): array {
        return $this->repositorio->getTodos();
    }

    public function getOne(int $usuarioId): object {
        return $this->repositorio->getPorId($usuarioId)->toJson();
    }
}
