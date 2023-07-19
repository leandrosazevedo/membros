<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Usuario;
use App\Exception\UsuarioException as UsuarioException;

final class UsuarioRepository extends BaseRepository {
    
    public function getPorId(int $id): Usuario {
        $query = 'SELECT `id`, `idIgreja`, `nome`, `email` FROM `usuario` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam('id', $id);
        $statement->execute();
        $objeto = $statement->fetchObject(Usuario::class);
        if(! $objeto) {
            throw new UsuarioException('Usuário não encontrado.', 404);
        }
        return $objeto;
    }

    //Alternativa GPT
//     public function getPorId(int $id): Usuario
// {
//     $query = 'SELECT u.*, i.* FROM `usuario` AS u
//               JOIN `igreja` AS i ON u.`idIgreja` = i.`id`
//               WHERE u.`id` = :id';

//     $statement = $this->database->prepare($query);
//     $statement->bindParam('id', $id);
//     $statement->execute();
//     $row = $statement->fetch();

//     if (! $row) {
//         throw new UsuarioException('Usuário não encontrado.', 404);
//     }

//     $usuario = (new Usuario())
//         ->setId((int)$row['id'])
//         ->setIgreja(new Igreja(
//             (int)$row['idIgreja'],
//             $row['nome_igreja'],
//             // Adicione aqui as demais propriedades da classe Igreja, se houver.
//         ))
//         ->setNome($row['nome'])
//         ->setEmail($row['email'])
//         ->setSenha($row['senha'])
//         ->setAtivo((bool)$row['ativo'])
//         ->setUltimoLogin($row['ultimoLogin']);

//     return $usuario;
// }


    public function getPorEmail(string $email): Usuario {
        $query = 'SELECT `id`, `nome`, `email` FROM `usuario` WHERE `email` = :email';
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
        $query = 'SELECT * FROM `usuario` WHERE `email` = :email';
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
        $query = $this->getQueryPorPagina();
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

    public function getQueryPorPagina(): string {
        return "
            SELECT `id`, `nome`, `email`
            FROM `usuario`
            WHERE `nome` LIKE CONCAT('%', :nome, '%')
            AND `email` LIKE CONCAT('%', :email, '%')
            ORDER BY `id`
        ";
    }

    /**
     * @return array<string>
     */
    public function getTodos(): array {
        $query = 'SELECT `id`, `nome`, `email` FROM `usuario` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();
        return (array) $statement->fetchAll();
    }

    public function login(string $email, string $senha): Usuario {
        $query = '
            SELECT *
            FROM `usuario`
            WHERE `email` = :email
            ORDER BY `id`
        ';
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
                (`nome`, `email`, `senha`)
            VALUES
                (:nome, :email, :senha)
        ';
        $statement = $this->database->prepare($query);
        $nome = $usuario->getNome();
        $email = $usuario->getEmail();
        $senha = $usuario->getSenha();
        $statement->bindParam('nome', $nome);
        $statement->bindParam('email', $email);
        $statement->bindParam('senha', $senha);
        $statement->execute();
        return $this->getPorId((int) $this->database->lastInsertId());
    }

    public function update(Usuario $usuario): Usuario {
        $query = '
            UPDATE `usuario` SET `nome` = :nome, `email` = :email WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $usuario->getId();
        $name = $usuario->getNome();
        $email = $usuario->getEmail();
        $statement->bindParam('id', $id);
        $statement->bindParam('name', $name);
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

}
