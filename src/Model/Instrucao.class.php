<?php

declare(strict_types=1);

namespace App\Model;

final class Instrucao extends BaseModel{

    private string $profissao;
    private string $grau;
    private string $linguaEstrangeira;
    private string $instrumentoMusical;

    public function getProfissao():string {
        return $this->profissao;
    }
    public function setProfissao($profissao): self{
        $this->profissao = $profissao;
        return $this;
    }

    public function getGrau():string {
        return $this->grau;
    }
    public function setGrau($grau): self{
        $this->grau = $grau;
        return $this;
    }

    public function getLinguaEstrangeira():string {
        return $this->linguaEstrangeira;
    }
    public function setLinguaEstrangeira($linguaEstrangeira): self{
        $this->linguaEstrangeira = $linguaEstrangeira;
        return $this;
    }

    public function getInstrumentoMusical():string {
        return $this->instrumentoMusical;
    }
    public function setInstrumentoMusical($instrumentoMusical): self{
        $this->instrumentoMusical = $instrumentoMusical;
        return $this;
    }
}