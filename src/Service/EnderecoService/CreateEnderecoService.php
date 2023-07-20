<?php

declare(strict_types=1);

namespace App\Service\EnderecoService;

use App\Model\Endereco;
use App\Service\EnderecoService\BaseEnderecoService;

final class CreateEnderecoService extends BaseEnderecoService {

    /**
     * @param array<string> $input
     */
    public function create(array $input): object{
        $data = $this->validador($input);
        $obj = $this->repositorio->create($data);
        return $obj->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validador(array $input): Endereco {
        $obj = json_decode((string) json_encode($input), false);
        parent::validaCamposObrigatorios($obj);
        $objNovo = new Endereco();
        $objNovo->setRua($obj->rua);
        $objNovo->setNumero($obj->numero);
        $objNovo->setBairro($obj->bairro);
        $objNovo->setCidade($obj->cidade);
        $objNovo->setUf($obj->uf);
        $objNovo->setCep($obj->cep);
        $objNovo->setComplemento($obj->complemento);
        //$this->repositorio->verificaResponsavelPorTelefone($obj->telefone);
        return $objNovo;
    }

}