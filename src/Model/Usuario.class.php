<?php

declare(strict_types=1);

namespace App\Model;

final class Usuario extends BaseModel
{
    private Igreja $igreja;
    private string $nome;
    private string $email;
    private string $senha;
    private bool $ativo;
    private string $ultimoLogin;

    public function getIgreja(): Igreja{
        return $this->igreja;
    }
    public function setIgreja(Igreja $igreja): self{
        $this->igreja = $igreja;
        return $this;
    }

    public function getNome(): string{
        return $this->nome;
    }
    public function setNome(string $nome): self{
        $this->nome = $nome;
        return $this;
    }

    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $email): self{
        $this->email = $email;
        return $this;
    }

    public function getSenha(): string{
        return $this->senha;
    }
    public function setSenha(string $senha): self{
        $this->senha = $senha;
        return $this;
    }

    public function isAtivo(): bool{
        return $this->ativo;
    }
    public function setAtivo(bool $ativo): self{
        $this->ativo = $ativo;
        return $this;
    }

    public function getUltimoLogin(): string{
        return $this->ultimoLogin;
    }
    public function setUltimoLogin(string $ultimoLogin): self{
        $this->ultimoLogin = $ultimoLogin;
        return $this;
    }
}