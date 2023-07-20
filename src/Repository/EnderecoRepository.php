<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Endereco;
use App\Exception\EnderecoException as EnderecoException;

final class EnderecoRepository extends BaseRepository {


    public function getPorId(int $id): Endereco {
        $query = 'SELECT `id`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `cep`, `complemento` FROM `endereco` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $objeto = $statement->fetchObject(Endereco::class);
        if(!$objeto) {
            throw new EnderecoException('Endereço não encontrado.', 404);
        }
        return $objeto;
    }

    public function create(Endereco $endereco): Endereco {
        $query = '
            INSERT INTO `endereco`
                (`rua`, `numero`, `bairro`, `cidade`, `uf`, `cep`, `complemento`)
            VALUES
                (:rua, :numero, :bairro, :cidade, :uf, :cep, :complemento)
        ';
        $statement = $this->database->prepare($query);
        $rua = $endereco->getRua();
        $numero = $endereco->getNumero();
        $bairro = $endereco->getBairro();
        $cidade = $endereco->getCidade();
        $uf = $endereco->getUf();
        $cep = $endereco->getCep();
        $complemento = $endereco->getComplemento() ?? null;
        $statement->bindParam('rua', $rua);
        $statement->bindParam('numero', $numero);
        $statement->bindParam('bairro', $bairro);
        $statement->bindParam('cidade', $cidade);
        $statement->bindParam('uf',$uf);
        $statement->bindParam('cep',$cep);
        $statement->bindParam('complemento',$complemento);
        $statement->execute();
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function update(Endereco $endereco): Endereco {
        $query = '
            UPDATE `endereco`
            SET
                `rua` = :rua,
                `numero` = :numero,
                `bairro` = :bairro,
                `cidade` = :cidade,
                `uf` = :uf,
                `cep` = :cep,
                `complemento` = :complemento
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $endereco->getId();
        $rua = $endereco->getRua();
        $numero = $endereco->getNumero();
        $bairro = $endereco->getBairro();
        $cidade = $endereco->getCidade();
        $uf = $endereco->getUf();
        $cep = $endereco->getCep();
        $complemento = $endereco->getComplemento() ?? null;
        $statement->bindParam('id', $id);
        $statement->bindParam('rua', $rua);
        $statement->bindParam('numero', $numero);
        $statement->bindParam('bairro', $bairro);
        $statement->bindParam('cidade', $cidade);
        $statement->bindParam('uf', $uf);
        $statement->bindParam('cep', $cep);
        $statement->bindParam('complemento', $complemento);
        $statement->execute();
        return $this->getPorId((int) $id);
    }

    public function delete(int $id): void {
        $query = 'DELETE FROM `endereco` WHERE `id` = :id';
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
        ?string $rua
    ): array {
        $params = [
            'rua' => is_null($rua) ? '' : $rua,
        ];
        $query = $this->getQuery("
            UPPER(`rua`) LIKE CONCAT('%', UPPER(:rua), '%')
        ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('rua', $params['rua']);
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

    private function getQuery($where, $orderBy=false): string {
        $query = 'SELECT * FROM `endereco` ';
        if($where){
            $query .= ' WHERE ' . $where;
        }
        if($orderBy){
            $query .= ' ORDER BY ' . $orderBy;
        }
        return $query;
    }

}