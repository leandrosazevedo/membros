<?php

declare(strict_types=1);
namespace App\Repository;

abstract class BaseRepository {
    public function __construct(
        protected \PDO $database
    ) { }

    protected function getBaseDeDados(): \PDO {
        return $this->database;
    }

    /**
     * @param array<string, int|string> $params
     */
    protected function getResultadoComPaginacao(
        string $query,
        int $paginaCorrente,
        int $porPagina,
        array $params,
        int $total
    ): array {
        return [
            'paginacao' => [
                'total' => $total,
                'paginas' => ceil($total / $porPagina),
                'paginaCorrente' => $paginaCorrente,
                'porPagina' => $porPagina,
            ],
            'resultado' => $this->getResultadosPorPagina($query, $paginaCorrente, $porPagina, $params),
        ];
    }

    /**
     * @param array<string, int|string> $params
     *
     * @return array<float|int|string>
     */
    protected function getResultadosPorPagina(
        string $query,
        int $paginaAtual,
        int $porPagina,
        array $params
    ): array {
        $offset = ($paginaAtual - 1) * $porPagina;
        $query .= " LIMIT ${porPagina} OFFSET ${offset}";
        $statement = $this->database->prepare($query);
        $statement->execute($params);
        return (array) $statement->fetchAll();
    }
}