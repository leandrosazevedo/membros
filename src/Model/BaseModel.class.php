<?php

declare(strict_types=1);

namespace App\Model;

abstract class BaseModel{
    protected int $id;
    
    public function toJson(): object {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int {
        return $this->id;
    }
}