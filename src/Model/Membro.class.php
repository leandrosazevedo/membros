<?php

declare(strict_types=1);

namespace App\Model;

final class Membro extends BaseModel{
   
    private Igreja $igreja;
    private Batismo $batismo;
    private string $dataAdmissao;
    private string $formaAdmissao;
    private string $igrejasAnteriores;
    private string $ministeriosAnteriores;
    private string $ministerioAtual;
    private string $donsEspirituais;
    private bool $ebd;
    private bool $pgm;
    private bool $dizimista;
    private bool $ofertante;
    private bool $contribuinte;
    private bool $pam;
    private bool $construcao;
    private string $status;
    private string $ultimaAtualizacao;

    public function getIgreja(): Igreja{
        return $this->igreja;
    }

    public function setIgreja(Igreja $igreja): self{
        $this->igreja = $igreja;
        return $this;
    }

    public function getBatismo(): Batismo{
        return $this->batismo;
    }
    public function setBatismo(Batismo $batismo): self{
        $this->batismo = $batismo;
        return $this;
    }

    public function getDataAdmissao(): string{
        return $this->dataAdmissao;
    }
    public function setDataAdmissao(string $dataAdmissao): self{
        $this->dataAdmissao = $dataAdmissao;
        return $this;
    }

    public function getFormaAdmissao(): string{
        return $this->formaAdmissao;
    }
    public function setFormaAdmissao(string $formaAdmissao): self{
        $this->formaAdmissao = $formaAdmissao;
        return $this;
    }

    public function getIgrejasAnteriores(): string{
        return $this->igrejasAnteriores;
    }
    public function setIgrejasAnteriores(string $igrejasAnteriores): self{
        $this->igrejasAnteriores = $igrejasAnteriores;
        return $this;
    }

    public function getMinisteriosAnteriores(): string{
        return $this->ministeriosAnteriores;
    }
    public function setMinisteriosAnteriores(string $ministeriosAnteriores): self{
        $this->ministeriosAnteriores = $ministeriosAnteriores;
        return $this;
    }

    public function getMinisterioAtual(): string{
        return $this->ministerioAtual;
    }
    public function setMinisterioAtual(string $ministerioAtual): self{
        $this->ministerioAtual = $ministerioAtual;
        return $this;
    }

    public function getDonsEspirituais(): string{
        return $this->donsEspirituais;
    }
    public function setDonsEspirituais(string $donsEspirituais): self{
        $this->donsEspirituais = $donsEspirituais;
        return $this;
    }

    public function isEbd(): bool{
        return $this->ebd;
    }
    public function setEbd(bool $ebd): self{
        $this->ebd = $ebd;
        return $this;
    }

    public function isPgm(): bool{
        return $this->pgm;
    }
    public function setPgm(bool $pgm): self{
        $this->pgm = $pgm;
        return $this;
    }

    public function isDizimista(): bool{
        return $this->dizimista;
    }
    public function setDizimista(bool $dizimista): self{
        $this->dizimista = $dizimista;
        return $this;
    }

    public function isOfertante(): bool{
        return $this->ofertante;
    }
    public function setOfertante(bool $ofertante): self{
        $this->ofertante = $ofertante;
        return $this;
    }

    public function isContribuinte(): bool{
        return $this->contribuinte;
    }
    public function setContribuinte(bool $contribuinte): self{
        $this->contribuinte = $contribuinte;
        return $this;
    }

    public function isPam(): bool{
        return $this->pam;
    }
    public function setPam(bool $pam): self{
        $this->pam = $pam;
        return $this;
    }

    public function isConstrucao(): bool{
        return $this->construcao;
    }
    public function setConstrucao(bool $construcao): self{
        $this->construcao = $construcao;
        return $this;
    }

    public function getStatus(): string{
        return $this->status;
    }
    public function setStatus(string $status): self{
        $this->status = $status;
        return $this;
    }

    public function getUltimaAtualizacao(): string{
        return $this->ultimaAtualizacao;
    }
    public function setUltimaAtualizacao(string $ultimaAtualizacao): self{
        $this->ultimaAtualizacao = $ultimaAtualizacao;
        return $this;
    }
}
