<?php

declare(strict_types=1);

namespace App\Model;

final class Igreja extends BaseModel{
    
    protected string $nome;
    protected string $abreviacao;
    protected string $dataFundacao;
    protected string $cnpj;
    protected Endereco $endereco;
    protected string $presidente;
    protected string $secretaria;
    protected string $email;
    protected string $telefone;

    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $nome): self {
        $this->nome = $nome;
        return $this;
    }

    public function getAbreviacao(): string {
        return $this->abreviacao;
    }
    public function setAbreviacao(string $abreviacao): self {
        $this->abreviacao = $abreviacao;
        return $this;
    }

    public function getDataFundacao(): string {
        return $this->dataFundacao;
    }
    public function setDataFundacao(string $dataFundacao): self {
        $this->dataFundacao = $dataFundacao;
        return $this;
    }

    public function getCnpj(): string {
        return $this->cnpj;
    }
    public function setCnpj(string $cnpj): self {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getEndereco(): Endereco {
        return $this->endereco;
    }
    public function setEndereco(Endereco $endereco): self {
        $this->endereco = $endereco;
        return $this;
    }

    public function getPresidente(): string {
        return $this->presidente;
    }
    public function setPresidente(string $presidente): self {
        $this->presidente = $presidente;
        return $this;
    }

    public function getSecretaria(): string {
        return $this->secretaria;
    }
    public function setSecretaria(string $secretaria): self {
        $this->secretaria = $secretaria;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }
    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }
    public function setTelefone(string $telefone): self {
        $this->telefone = $telefone;
        return $this;
    }
}