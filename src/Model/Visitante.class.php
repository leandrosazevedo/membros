<?php

declare(strict_types=1);

namespace App\Model;

final class Visitante extends BaseModel{
    
    private Pessoa $pessoa;
    private Igreja $igreja;
    private string $dataInicio;
    private string $observacao;

    public function getPessoa(): Pessoa{
        return $this->pessoa;
    }
    public function setPessoa(Pessoa $pessoa): self{
        $this->pessoa = $pessoa;
        return $this;
    }

    public function getIgreja(): Igreja{
        return $this->igreja;
    }
    public function setIgreja(Igreja $igreja): self{
        $this->igreja = $igreja;
        return $this;
    }

    public function getDataInicio(): string{
        return $this->dataInicio;
    }
    public function setDataInicio(string $dataInicio): self{
        $this->dataInicio = $dataInicio;
        return $this;
    }

    public function getObservacao(): string{
        return $this->observacao;
    }
    public function setObservacao(string $observacao): self{
        $this->observacao = $observacao;
        return $this;
    }
}
