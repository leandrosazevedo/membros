<?php

declare(strict_types=1);

namespace App\Model;

final class Endereco extends BaseModel{
    
    protected string $rua;
    protected ?string $numero;
    protected string $bairro;
    protected string $cidade;
    protected string $uf;
    protected string $cep;
    protected ?string $complemento;
    
    public function getRua(): string {
        return $this->rua;
    }
    public function setRua(string $rua): self {
        $this->rua = $rua;
        return $this;
    }

    public function getNumero(): ?string {
        return $this->numero;
    }
    public function setNumero(?string $numero): self {
        $this->numero = $numero;
        return $this;
    }

    public function getBairro(): string {
        return $this->bairro;
    }
    public function setBairro(string $bairro): self {
        $this->bairro = $bairro;
        return $this;
    }

    public function getCidade(): string {
        return $this->cidade;
    }
    public function setCidade(string $cidade): self {
        $this->cidade = $cidade;
        return $this;
    }

    public function getUf(): string {
        return $this->uf;
    }
    public function setUf(string $uf): self {
        $this->uf = $uf;
        return $this;
    }

    public function getCep(): string {
        return $this->cep;
    }
    public function setCep(string $cep): self {
        $this->cep = $cep;
        return $this;
    }

    public function getComplemento(): ?string {
        return $this->complemento;
    }
    public function setComplemento(?string $complemento): self {
        $this->complemento = $complemento;
        return $this;
    }
    
}