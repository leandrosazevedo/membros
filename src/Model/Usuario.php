<?php

declare(strict_types=1);

namespace App\Model;

final class Usuario extends BaseModel{
    private string $nome;
    private string $email;
    private string $senha;

    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }
    public function getSenha(): string {
        return $this->senha;
    }
    public function setSenha(string $senha): self {
        $this->senha = $senha;
        return $this;
    }
}