<?php

declare(strict_types=1);

namespace App\Model;

final class HistoricoMembro extends BaseModel{

    private Membro $membro;
    private string $status;
    private string $data;

    public function getMembro(): Membro{
        return $this->membro;
    }
    public function setMembro(Membro $membro): self{
        $this->membro = $membro;
        return $this;
    }

    public function getStatus(): string{
        return $this->status;
    }
    public function setStatus(string $status): self{
        $this->status = $status;
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
