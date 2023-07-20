<?php

declare(strict_types=1);
namespace App\Service\EnderecoService;

use App\Exception\EnderecoException;
use App\Service\BaseService;
use App\Model\Endereco;
use App\Repository\EnderecoRepository;

abstract class BaseEnderecoService extends BaseService{

    public function __construct(
        protected EnderecoRepository $repositorio
    ) { }
    
    public function getPorId(int $id): Endereco {
        return $this->repositorio->getPorId($id);
    }

    protected function validaCamposObrigatorios(Endereco $obj) {
        $camposObrigatorios = ['rua', 'bairro', 'cidade', 'uf', 'cep'];
        foreach ($camposObrigatorios as $campo) {
            if (!$obj->{'get' . ucfirst($campo)}()) {
                throw new EnderecoException('O campo "' . $campo . '" é obrigatório.', 400);
            }
        }
    }
}