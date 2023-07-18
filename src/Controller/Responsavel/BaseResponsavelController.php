<?php

declare(strict_types=1);

namespace App\Controller\Responsavel;

use App\Controller\BaseController;
use App\Repository\ResponsavelRepository;
use App\Service\ResponsavelService\FindResponsavelService;
use App\Service\ResponsavelService\CreateResponsavelService;
use App\Service\ResponsavelService\DeleteResponsavelService;
use App\Service\ResponsavelService\UpdateResponsavelService;

abstract class BaseResponsavelController extends BaseController{
    
    protected function setRespositorio(){
        $this->repositorio = new ResponsavelRepository($this->container->get('db'));
    }

    protected function getFindService(): FindResponsavelService {
        return new FindResponsavelService($this->repositorio);
    }

    protected function getCreateService(): CreateResponsavelService{
        return new CreateResponsavelService($this->repositorio);
    }

    protected function getUpdateService(): UpdateResponsavelService {
        return new UpdateResponsavelService($this->repositorio);
    }

    protected function getDeleteService(): DeleteResponsavelService {
        return new DeleteResponsavelService($this->repositorio);
    }

}