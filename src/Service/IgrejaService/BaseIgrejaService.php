<?php

declare(strict_types=1);
namespace App\Service\IgrejaService;

use App\Exception\IgrejaException;
use App\Service\BaseService;
use App\Model\Igreja;
use App\Repository\IgrejaRepository;

abstract class BaseIgrejaService extends BaseService{

    public function __construct(
        protected IgrejaRepository $repositorio
    ) { }
    
    public function getPorId(int $id): Igreja {
        return $this->repositorio->getPorId($id);
    }

    protected function validaCamposObrigatorios(Igreja $obj) {
        $camposObrigatorios = ['nome', 'abreviacao',];
        foreach ($camposObrigatorios as $campo) {
            if (!$obj->{'get' . ucfirst($campo)}()) {
                throw new IgrejaException('O campo "' . $campo . '" é obrigatório.', 400);
            }
        }
    }
}