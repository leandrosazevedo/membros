<?php

declare(strict_types=1);

namespace App\Model;

abstract class Pessoa extends BaseModel{
    private string $nome;
    
    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }
}