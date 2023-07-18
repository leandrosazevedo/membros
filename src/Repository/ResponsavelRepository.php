<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Responsavel;
use App\Exception\ResponsavelException;

final class ResponsavelRepository extends BaseRepository {

    public function getPorId(int $responsavelId): Responsavel {
        $query = 'SELECT `id`, `nome`, `telefone` FROM `responsavel` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $responsavelId);
        $statement->execute();
        $responsavel = $statement->fetchObject(Responsavel::class);
        if (! $responsavel) {
            throw new ResponsavelException('Responsável não encontrado.', 404);
        }
        return $responsavel;
    }

    public function create(Responsavel $responsavel): Responsavel {
        $query = '
            INSERT INTO `responsavel`
                (`nome`, `telefone`)
            VALUES
                (:nome, :telefone)
        ';
        $statement = $this->database->prepare($query);
        $nome = $responsavel->getNome();
        $telefone = $responsavel->getTelefone();
        $statement->bindParam('nome', $nome);
        $statement->bindParam('telefone', $telefone);
        $statement->execute();
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function verificaResponsavelPorTelefone(string $telefone): void {
        $query = 'SELECT * FROM `responsavel` WHERE `telefone` = :telefone';
        $statement = $this->database->prepare($query);
        $statement->bindParam('telefone', $telefone);
        $statement->execute();
        $obj = $statement->fetchObject();
        if ($obj) {
            throw new ResponsavelException('Telefone já existe.', 400);
        }
    }

    public function delete(int $id): void {
        $query = 'DELETE FROM `responsavel` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
    }

     /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaAtual,
        int $porPagina,
        ?string $nome,
        ?string $telefone
    ): array {
        $params = [
            'nome' => is_null($nome) ? '' : $nome,
            'telefone' => is_null($telefone) ? '' : $telefone,
        ];
        $query = $this->getQueryPorPagina();
        $statement = $this->database->prepare($query);
        $statement->bindParam('nome', $params['nome']);
        $statement->bindParam('telefone', $params['telefone']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultadoComPaginacao(
            $query,
            $paginaAtual,
            $porPagina,
            $params,
            $total
        );
    }

    public function getQueryPorPagina(): string {
        return "
            SELECT `id`, `nome`, `telefone`
            FROM `responsavel`
            WHERE `nome` LIKE CONCAT('%', :nome, '%')
            AND `telefone` LIKE CONCAT('%', :telefone, '%')
            ORDER BY `id`
        ";
    }

        /**
     * @return array<string>
     */
    public function getTodos(): array {
        $query = 'SELECT `id`, `nome`, `telefone` FROM `responsavel` ORDER BY `nome`';
        $statement = $this->database->prepare($query);
        $statement->execute();
        return (array) $statement->fetchAll();
    }

    public function update(Responsavel $responsavel): Responsavel {
        $query = '
            UPDATE `responsavel` SET `nome` = :nome, `telefone` = :telefone WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $responsavel->getId();
        $nome = $responsavel->getNome();
        $telefone = $responsavel->getTelefone();
        $statement->bindParam('id', $id);
        $statement->bindParam('nome', $nome);
        $statement->bindParam('telefone', $telefone);
        $statement->execute();
        return $this->getPorId((int) $id);
    }
}