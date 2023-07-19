<?php

declare(strict_types=1);

namespace App\Model;

final class Batismo extends BaseModel{
    private string $data;
    private string $igreja;
    private string $pastor;

    public function getData(): string{
        return $this->data;
    }
    public function setData(string $data): self{
        $this->data = $data;
        return $this;
    }

    public function getIgreja(): string{
        return $this->igreja;
    }
    public function setIgreja(string $igreja): self{
        $this->igreja = $igreja;
        return $this;
    }

    public function getPastor(): string{
        return $this->pastor;
    }
    public function setPastor(string $pastor): self{
        $this->pastor = $pastor;
        return $this;
    }
}
