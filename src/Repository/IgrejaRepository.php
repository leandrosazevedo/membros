<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Igreja;
use App\Exception\IgrejaException;
use App\Model\Endereco;

final class IgrejaRepository extends BaseRepository {

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

    public function getPorId(int $id): Igreja {
        $query = 'SELECT i.*, e.* FROM `igreja` AS i
                    INNER JOIN `endereco` AS e ON i.`idEndereco` = e.`id`
                    WHERE `id` = :id';

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
                (`nome`, `abreviacao`, `dataFundacao`, `cnpj`, `idEndereco`, `presidente`, `secretaria`, `email`, `telefone`)
            VALUES
                (:nome, :abreviacao, :dataFundacao, :cnpj, :idEndereco, :presidente, :secretaria, :email, :telefone)
        ';
        $statement = $this->database->prepare($query);
        $nome = $igreja->getNome();
        $abreviacao = $igreja->getAbreviacao();
        $dataFundacao = $igreja->getDataFundacao();
        $cnpj = $igreja->getCnpj();
        $idEndereco = $igreja->getEndereco().getId();
        $presidente = $igreja->getPresidente();
        $secretaria = $igreja->getSecretaria();
        $email = $igreja->getEmail();
        $telefone = $igreja->getTelefone();



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