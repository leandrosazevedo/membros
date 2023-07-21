<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Igreja;
use App\Exception\IgrejaException;
use App\Model\Endereco;

final class IgrejaRepository extends BaseRepository {


    public function getPorId(int $id): Igreja {
        $query = $this->getQuery(" `id` = :id ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $row = $statement->fetch();
        if (!$row) {
            throw new IgrejaException('Igreja não encontrada.', 404);
        }
        return $this->montaObjeto($row);
    }

    public function create(Igreja $igreja): Igreja {
        $query = '
            INSERT INTO `igreja`
                (`nome`, `abreviacao`, `dataFundacao`, `cnpj`, `idEndereco`,
                `presidente`, `secretaria`, `email`, `telefone`)
            VALUES
                (:nome, :abreviacao, :dataFundacao, :cnpj, :idEndereco, :presidente, :secretaria, :email, :telefone)
        ';
        $statement = $this->database->prepare($query);

        $nome = $igreja->getNome();
        $abreviacao = $igreja->getAbreviacao();
        $dataFundacao = $igreja->getDataFundacao();
        $cnpj = $igreja->getCnpj();
        $endereco = $igreja->getEndereco();
        $presidente = $igreja->getPresidente();
        $secretaria = $igreja->getSecretaria();
        $email = $igreja->getEmail();
        $telefone = $igreja->getTelefone();

        $statement->bindParam('nome', $nome);
        $statement->bindParam('abreviacao', $abreviacao);
        $statement->bindParam('dataFundacao', $dataFundacao);
        $statement->bindParam('cnpj', $cnpj);
        $statement->bindParam('idEndereco', $endereco->getId());
        $statement->bindParam('presidente', $presidente);
        $statement->bindParam('secretaria', $secretaria);
        $statement->bindParam('email', $email);
        $statement->bindParam('telefone', $telefone);
        $statement->execute();
        
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function delete(int $id): void {
        $query = 'DELETE FROM `igreja` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
    }

    public function update(Igreja $igreja): Igreja {
        $query = '
            UPDATE `igreja`
            SET
                `nome` = :nome,
                `abreviacao` = :abreviacao,
                `dataFundacao` = :dataFundacao,
                `cnpj` = :cnpj,
                `idEndereco` = :idEndereco,
                `presidente` = :presidente,
                `secretaria` = :secretaria,
                `email` = :email,
                `telefone` = :telefone
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $igreja->getId();
        $nome = $igreja->getNome();
        $abreviacao = $igreja->getAbreviacao();
        $dataFundacao = $igreja->getDataFundacao();
        $cnpj = $igreja->getCnpj();
        $endereco = $igreja->getEndereco();
        $presidente = $igreja->getPresidente();
        $secretaria = $igreja->getSecretaria();
        $email = $igreja->getEmail();
        $telefone = $igreja->getTelefone();
        $statement->bindParam('id', $id);
        $statement->bindParam('nome', $nome);
        $statement->bindParam('abreviacao', $abreviacao);
        $statement->bindParam('dataFundacao', $dataFundacao);
        $statement->bindParam('cnpj', $cnpj);
        $statement->bindParam('idEndereco', $endereco->getId());
        $statement->bindParam('presidente', $presidente);
        $statement->bindParam('secretaria', $secretaria);
        $statement->bindParam('email', $email);
        $statement->bindParam('telefone', $telefone);
        $statement->execute();
        return $this->getPorId((int) $id);
    }

    public function getPorPagina(
        int $paginaAtual,
        int $porPagina,
        ?string $nome,
        ?string $presidente
    ): array {
        $params = [
            'nome' => is_null($nome) ? '' : $nome,
            'presidente' => is_null($presidente) ? '' : $presidente,
        ];
        $query = $this->getQuery("
            UPPER(`nome`) LIKE CONCAT('%', UPPER(:nome), '%')
            AND UPPER(`presidente`) LIKE CONCAT('%', UPPER(:presidente), '%')
        ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('nome', $params['nome']);
        $statement->bindParam('presidente', $params['presidente']);
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

    public function verificaIgrejaPorNome(string $nome): void {
        $query = 'SELECT * FROM `igreja` WHERE `nome` = :nome';
        $statement = $this->database->prepare($query);
        $statement->bindParam('nome', $nome);
        $statement->execute();
        $usuario = $statement->fetchObject();
        if ($usuario) {
            throw new IgrejaException('Igreja já existe.', 400);
        }
    }

    protected function formataListaResultado(array $objectArray): array{
        $objArray = [];
        foreach($objectArray as $obj){
            array_push($objArray,$this->montaObjeto($obj));
        }
        return $objectArray;
    }

    private function getQuery($where, $orderBy=false): string {
        $query = 'SELECT i.*, e.* FROM `igreja` AS i
                    INNER JOIN `endereco` AS e ON i.`idEndereco` = e.`id` ';
        if($where){
            $query .= ' WHERE ' . $where;
        }
        if($orderBy){
            $query .= ' ORDER BY ' . $orderBy;
        }
        return $query;
    }

    private function montaObjeto(array $row): Igreja {
        return (new Igreja())
        ->setNome($row['nome'])
        ->setAbreviacao($row['abreviacao'])
        ->setDataFundacao($row['dataFundacao'])
        ->setCnpj($row['cnpj'])
        ->setEndereco((new Endereco)
            ->setRua($row['rua'])
            ->setBairro($row['bairro'])
            ->setCidade($row['cidade'])
            ->setUf($row['uf'])
            ->setCep($row['cep'])
            ->setComplemento($row['complemento'])
            ->setId($row['idEndereco'])
        )
        ->setPresidente($row['presidente'])
        ->setSecretaria($row['secretaria'])
        ->setEmail($row['email'])
        ->setTelefone($row['telefone'])
        ->setId($row['id']);
    }
}