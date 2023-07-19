<?php

declare(strict_types=1);

namespace App\Model;

final class Ocorrencia extends BaseModel{

    private Membro $membro;
    private string $descricao;
    private string $data;

    public function getMembro(): Membro{
        return $this->membro;
    }
    public function setMembro(Membro $membro): self{
        $this->membro = $membro;
        return $this;
    }

    public function getDescricao(): string{
        return $this->descricao;
    }
    public function setDescricao(string $descricao): self{
        $this->descricao = $descricao;
        return $this;
    }

    public function getData(): string{
        return $this->data;
    }
    public function setData(string $data): self{
        $this->data = $data;
        return $this;
    }
}
