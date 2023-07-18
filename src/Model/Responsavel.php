<?php

declare(strict_types=1);

namespace App\Model;

final class Responsavel extends Pessoa{
    private string $telefone;

    public function getTelefone(): string {
        return $this->telefone;
    }
    public function setTelefone(string $telefone): self {
        $this->telefone = $telefone;
        return $this;
    }
}