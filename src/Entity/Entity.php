<?php

namespace Bot\Entity;

use Bot\General\ArrayableInterface;
use Exception;
use ReflectionClass;
use ReflectionProperty;
use ReflectionUnionType;

abstract class Entity implements ArrayableInterface
{
    final public function mapArrayValue($name, $keyField)
    {
        if (!is_array($this->$name)) {
            //TODO: Exception
            throw new Exception();
        }
        $newAr = [];
        foreach ($this->$name as $value) {
            $newAr[$value->$keyField] = $value;
        }
        $this->$name = $newAr;
    }

    final public function toArray(): array
    {
        $array = [];
        foreach ($this->getProperties() as $property) {
            $name = $property->getName();
            if(is_array($this->$name) && $property->getType() instanceof ReflectionUnionType) {
                //TODO: second type is instance of Entity
            }
        }
        return $array;
    }

    /**
     * @return ReflectionProperty[]
     */
    private function getProperties(): array
    {
        return (new ReflectionClass($this))->getProperties();
    }
}