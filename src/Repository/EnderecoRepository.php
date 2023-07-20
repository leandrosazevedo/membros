<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Endereco;
use App\Exception\EnderecoException as EnderecoException;

final class EnderecoRepository extends BaseRepository {


    public function getPorId(int $id): Endereco {
        $query = 'SELECT * FROM `endereco` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $objeto = $statement->fetchObject(Endereco::class);
        if(!$objeto) {
            throw new EnderecoException('Endereço não encontrado.', 404);
        }
        return $objeto;
    }

    public function criar(Endereco $endereco): Endereco {
        $query = '
            INSERT INTO `endereco`
                (`rua`, `bairro`, `cidade`, `uf`, `cep`, `complemento`)
            VALUES
                (:rua, :bairro, :cidade, :uf, :cep, :complemento)
        ';
        $statement = $this->database->prepare($query);
        $rua = $endereco->getRua();
        $bairro = $endereco->getBairro();
        $cidade = $endereco->getCidade();
        $uf = $endereco->getUf();
        $cep = $endereco->getCep();
        $complemento = $endereco->getComplemento() ?? null;
        $statement->bindParam('rua', $rua);
        $statement->bindParam('bairro', $bairro);
        $statement->bindParam('cidade', $cidade);
        $statement->bindParam('uf',$uf);
        $statement->bindParam('cep',$cep);
        $statement->bindParam('complemento',$complemento);
        $statement->execute();
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function atualizar(Endereco $endereco): Endereco {
        $query = '
            UPDATE `endereco`
            SET
                `rua` = :rua,
                `bairro` = :bairro,
                `cidade` = :cidade,
                `uf` = :uf,
                `cep` = :cep,
                `complemento` = :complemento,
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $endereco->getId();
        $rua = $endereco->getRua();
        $bairro = $endereco->getBairro();
        $cidade = $endereco->getCidade();
        $uf = $endereco->getUf();
        $cep = $endereco->getCep();
        $complemento = $endereco->getComplemento() ?? null;
        $statement->bindParam('id', $id);
        $statement->bindParam('rua', $rua);
        $statement->bindParam('bairro', $bairro);
        $statement->bindParam('cidade', $cidade);
        $statement->bindParam('uf', $uf);
        $statement->bindParam('cep', $cep);
        $statement->bindParam('complemento', $complemento);
        $statement->execute();
        return $this->getPorId((int) $id);
    }

    public function deletar(int $id): void {
        $query = 'DELETE FROM `endereco` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
    }

}