<?php

declare(strict_types=1);

namespace App\Service\IgrejaService;

use App\Model\Igreja;
use App\Service\IgrejaService\BaseIgrejaService;

final class CreateIgrejaService extends BaseIgrejaService {

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
    private function validador(array $input): Igreja {
        $obj = json_decode((string) json_encode($input), false);
        parent::validaCamposObrigatorios($obj);
        $objNovo = new Igreja();
        $objNovo->setNome($obj->nome);
        $objNovo->setAbreviacao($obj->abreviacao);
        $objNovo->setDataFundacao($obj->dataFundacao);
        $objNovo->setCnpj($obj->cnpj);
        $objNovo->setEndereco($obj->endereco);
        $objNovo->setPresidente($obj->presidente);
        $objNovo->setSecretaria($obj->secretaria);
        $objNovo->setEmail($obj->email);
        $objNovo->setTelefone($obj->telefone);
        $this->repositorio->verificaIgrejaPorNome($obj->nome);
        return $objNovo;
    }

}