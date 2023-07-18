<?php

declare(strict_types=1);

namespace App\Model;
use Respect\Validation\Rules\Date;

final class Crianca extends Pessoa{
    private Date $dataNascimento;
    private string $restricaoAlimentar;
    private string $foto;
    private Responsavel $responsavel;
    
    public function getDataNascimento(): Date {
        return $this->dataNascimento;
    }
    public function setDataNascimento(Date $dataNascimento): self {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    public function getRestricaoAlimentar(): string {
        return $this->restricaoAlimentar;
    }
    public function setRestricaoAlimentar(string $restricaoAlimentar): self {
        $this->restricaoAlimentar = $restricaoAlimentar;
        return $this;
    }

    public function getFoto(): string {
        return $this->foto;
    }
    public function setFoto(string $foto): self {
        $this->foto = $foto;
        return $this;
    }

    public function getResponsavel(): Responsavel {
        return $this->responsavel;
    }
    public function setResponsavel(Responsavel $responsavel): self {
        $this->responsavel = $responsavel;
        return $this;
    }
}