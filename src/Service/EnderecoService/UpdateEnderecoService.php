<?php

declare(strict_types=1);
namespace App\Service\EnderecoService;

use App\Model\Endereco;
use App\Service\EnderecoService\BaseEnderecoService;
use JMS\Serializer\SerializerBuilder;

final class UpdateEnderecoService extends BaseEnderecoService {
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
    private function validadorData(array $input, int $id): Endereco {
        $serializer = SerializerBuilder::create()->build();
        $data = json_decode((string) json_encode($input), false);
        $endereco = $serializer->deserialize(json_encode($data), Endereco::class, 'json');
        $endereco->setId($id);
        parent::validaCamposObrigatorios($endereco);
        return $endereco;
    }
}
