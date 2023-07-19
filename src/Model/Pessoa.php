<?php

declare(strict_types=1);

namespace App\Model;

abstract class Pessoa extends BaseModel{

    private string $nome;
    private string $sexo;
    private string $dataNascimento;
    private string $estadoCivil;
    private string $dataCasamento;
    private string $conjuge;
    private string $tipoSanguineo;
    private string $cpf;
    private string $naturalidadeCidade;
    private string $naturalidadeUF;
    private string $nacionalidade;
    private string $mae;
    private string $pai;
    private string $email;
    private string $celular;
    private string $whatsapp;
    private Endereco $endereco;
    private Instrucao $instrucao;

    public function getNome(): string{
        return $this->nome;
    }
    public function setNome(string $nome): self{
        $this->nome = $nome;
        return $this;
    }

    public function getSexo(): string{
        return $this->sexo;
    }
    public function setSexo(string $sexo): self{
        $this->sexo = $sexo;
        return $this;
    }

    public function getDataNascimento(): string{
        return $this->dataNascimento;
    }
    public function setDataNascimento(string $dataNascimento): self{
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    public function getEstadoCivil(): string{
        return $this->estadoCivil;
    }
    public function setEstadoCivil(string $estadoCivil): self{
        $this->estadoCivil = $estadoCivil;
        return $this;
    }

    public function getDataCasamento(): string{
        return $this->dataCasamento;
    }
    public function setDataCasamento(string $dataCasamento): self{
        $this->dataCasamento = $dataCasamento;
        return $this;
    }

    public function getConjuge(): string{
        return $this->conjuge;
    }
    public function setConjuge(string $conjuge): self{
        $this->conjuge = $conjuge;
        return $this;
    }

    public function getTipoSanguineo(): string{
        return $this->tipoSanguineo;
    }

    public function setTipoSanguineo(string $tipoSanguineo): self{
        $this->tipoSanguineo = $tipoSanguineo;
        return $this;
    }

    public function getCpf(): string{
        return $this->cpf;
    }
    public function setCpf(string $cpf): self{
        $this->cpf = $cpf;
        return $this;
    }

    public function getNaturalidadeCidade(): string{
        return $this->naturalidadeCidade;
    }
    public function setNaturalidadeCidade(string $naturalidadeCidade): self{
        $this->naturalidadeCidade = $naturalidadeCidade;
        return $this;
    }

    public function getNaturalidadeUF(): string{
        return $this->naturalidadeUF;
    }
    public function setNaturalidadeUF(string $naturalidadeUF): self{
        $this->naturalidadeUF = $naturalidadeUF;
        return $this;
    }

    public function getNacionalidade(): string{
        return $this->nacionalidade;
    }
    public function setNacionalidade(string $nacionalidade): self{
        $this->nacionalidade = $nacionalidade;
        return $this;
    }

    public function getMae(): string{
        return $this->mae;
    }
    public function setMae(string $mae): self{
        $this->mae = $mae;
        return $this;
    }

    public function getPai(): string{
        return $this->pai;
    }
    public function setPai(string $pai): self{
        $this->pai = $pai;
        return $this;
    }

    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $email): self{
        $this->email = $email;
        return $this;
    }

    public function getCelular(): string{
        return $this->celular;
    }
    public function setCelular(string $celular): self{
        $this->celular = $celular;
        return $this;
    }

    public function getWhatsapp(): string{
        return $this->whatsapp;
    }
    public function setWhatsapp(string $whatsapp): self{
        $this->whatsapp = $whatsapp;
        return $this;
    }

    public function getEndereco(): Endereco{
        return $this->endereco;
    }
    public function setEndereco(Endereco $endereco): self{
        $this->endereco = $endereco;
        return $this;
    }

    public function getInstrucao(): Instrucao{
        return $this->instrucao;
    }
    public function setInstrucao(Instrucao $instrucao): self{
        $this->instrucao = $instrucao;
        return $this;
    }
}