<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Usuario;
use App\Exception\UsuarioException as UsuarioException;

final class UsuarioRepository extends BaseRepository {
    
    public function getPorId(int $id): Usuario {
        $query = $this->getQuery(" `id` = :id ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $objeto = $statement->fetchObject(Usuario::class);
        if(! $objeto) {
            throw new UsuarioException('Usuário não encontrado.', 404);
        }
        return $objeto;
    }

    public function getPorEmail(string $email): Usuario {
        $query = $this->getQuery(" `email` = :email ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $obj = $statement->fetchObject(Usuario::class);
        if (!$obj) {
            throw new UsuarioException('Usuário não encontrado', 404);
        }
        return $obj;
    }

    public function verificaPorEmail(string $email): void {
        $query = $this->getQuery(" `email` = :email ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $obj = $statement->fetchObject();
        if ($obj) {
            throw new UsuarioException('Email já existe.', 400);
        }
    }

    /**
     * @return array<string>
     */
    public function getPorPagina(
        int $paginaAtual,
        int $porPagina,
        ?string $nome,
        ?string $email
    ): array {
        $params = [
            'nome' => is_null($nome) ? '' : $nome,
            'email' => is_null($email) ? '' : $email,
        ];
        $query = $this->getQuery(" UPPER(`nome`) LIKE CONCAT('%', UPPER(:nome), '%')
                                    AND UPPER(`email`) LIKE CONCAT('%', UPPER(:email), '%') ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('nome', $params['nome']);
        $statement->bindParam('email', $params['email']);
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

    public function login(string $email, string $senha): Usuario {
        $query = $this->getQuery(" `email` = :email ");
        $statement = $this->database->prepare($query);
        $statement->bindParam('email', $email);
        $statement->execute();
        $obj = $statement->fetchObject(Usuario::class);
        if (!$obj) {
            throw new UsuarioException('Falha no Login: Email ou senha incorreto.', 400);
        }
        if (!password_verify($senha, $obj->getSenha())) {
            throw new UsuarioException('Falha no Login: Email ou senha incorreto.', 400);
        }
        return $obj;
    }

    public function create(Usuario $usuario): Usuario {
        $query = '
            INSERT INTO `usuario`
                (`nome`, `idIgreja`, `email`, `senha`)
            VALUES
                (:nome, :idIgreja, :email, :senha)
        ';
        $statement = $this->database->prepare($query);
        $nome = $usuario->getNome();
        $igreja = $usuario->getIgreja();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $statement->bindParam('nome', $nome);
        $statement->bindParam('idIgreja', $igreja->getId());
        $statement->bindParam('email', $email);
        $statement->bindParam('senha', $senha);
        $statement->execute();
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function update(Usuario $usuario): Usuario {
        $query = '
            UPDATE `usuario` SET
                `nome` = :nome,
                `email` = :email
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $usuario->getId();
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $statement->bindParam('id', $id);
        $statement->bindParam('nome', $nome);
        $statement->bindParam('email', $email);
        $statement->execute();
        return $this->getPorId((int) $id);
    }

    public function delete(int $id): void {
        $query = 'DELETE FROM `usuario` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
    }

    private function getQuery($where, $orderBy=false): string {
        $query = 'SELECT `id`, `idIgreja`, `nome`, `email`
                    FROM `usuario` ';
        if($where){
            $query .= ' WHERE ' . $where;
        }
        if($orderBy){
            $query .= ' ORDER BY ' . $orderBy;
        }
        return $query;
    }

}
