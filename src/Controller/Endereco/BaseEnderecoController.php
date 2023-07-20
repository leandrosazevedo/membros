<?php

declare(strict_types=1);

namespace App\Controller\Endereco;

use App\Controller\BaseController;
use App\Repository\EnderecoRepository;
use App\Service\EnderecoService\FindEnderecoService;
use App\Service\EnderecoService\CreateEnderecoService;
use App\Service\EnderecoService\DeleteEnderecoService;
use App\Service\EnderecoService\UpdateEnderecoService;

abstract class BaseEnderecoController extends BaseController{
    
    protected function setRespositorio(){
        $this->repositorio = new EnderecoRepository($this->container->get('db'));
    }

    protected function getFindService(): FindEnderecoService {
        return new FindEnderecoService($this->repositorio);
    }

    protected function getCreateService(): CreateEnderecoService{
        return new CreateEnderecoService($this->repositorio);
    }

    protected function getUpdateService(): UpdateEnderecoService {
        return new UpdateEnderecoService($this->repositorio);
    }

    protected function getDeleteService(): DeleteEnderecoService {
        return new DeleteEnderecoService($this->repositorio);
    }

}