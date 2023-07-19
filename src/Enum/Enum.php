<?php

namespace App\Enum;

use InvalidArgumentException;
use ReflectionClass;

abstract class Enum {
    
    protected $value;

    protected function __construct($value){
        $this->value = $value;
    }

    public function getValue(){
        return $this->value;
    }

    public static function isValid($value){
        return in_array($value, static::getConstants(), true);
    }

    public static function getConstants(){
        $reflection = new ReflectionClass(static::class);
        return $reflection->getConstants();
    }

    public static function fromValue($value){
        if (!static::isValid($value)) {
            throw new InvalidArgumentException("Valor inválido para o enum " . static::class);
        }
        return new static($value);
    }
}
