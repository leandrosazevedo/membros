<?php

declare(strict_types=1);
namespace App\Service\IgrejaService;

use App\Model\Igreja;
use App\Service\IgrejaService\BaseIgrejaService;
use JMS\Serializer\SerializerBuilder;

final class UpdateIgrejaService extends BaseIgrejaService {
    /**
     * @param array<string> $input
     */
    public function update(array $input, int $id): object {
        $data = $this->validadorData($input, $id);
        $obj = $this->repositorio->update($data);
        return $obj->toJson();
    }

    /**
     * @param array<string> $input
     */
    private function validadorData(array $input, int $id): Igreja {
        $serializer = SerializerBuilder::create()->build();
        $data = json_decode((string) json_encode($input), false);
        $igreja = $serializer->deserialize(json_encode($data), Igreja::class, 'json');
        $igreja->setId($id);
        parent::validaCamposObrigatorios($igreja);
        return $igreja;
    }
}
