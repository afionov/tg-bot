<?php

namespace Bot\Entity;

use Bot\General\ArrayableInterface;
use Exception;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

abstract class Entity implements EntityInterface, ArrayableInterface
{
    final public static function createFromArray(array $data): static
    {
        return (new static())->fillEntity($data);
    }

    final protected function fillEntity(array $data)
    {
        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties();
        foreach($properties as $property) {
            $name = $property->getName();
            if(!isset($data[$name])) {
                continue;
            }
            $type = $property->getType();
            $type instanceof ReflectionNamedType
                ? $this->fillEntityPropertyWithNamedType($type, $name, $data[$name])
                : $this->fillEntityPropertyWithUnionType($type, $name, $data[$name]);
        }
        return $this;
    }

    final protected function fillEntityPropertyWithNamedType(ReflectionNamedType $type, $name, $value)
    {
        if($type->isBuiltin()) {
            $this->$name = $value;
            return;
        }
        $typeName = $type->getName();
        $object = new $typeName();
        if(!$object instanceof Entity) {
            throw new Exception();
        }
        $this->$name = $object->fillEntity($value);
    }

    final protected function fillEntityPropertyWithUnionType(ReflectionUnionType $type, $name, $value)
    {
        $arTypes = $type->getTypes();
        $entityType = $arTypes[0];
        //TODO: ref arTypes[0] && arTypes[1]
        if(!$this->validateUnionType($arTypes[1], $entityType)) {
            throw new Exception();
        }
        $arEntities = [];
        foreach($value as $newEntity) {
            $class = $entityType->getName();
            $arEntities[] = (new $class())->fillEntity($newEntity);
        }
        $this->$name = $arEntities;
    }

    final protected function validateUnionType(ReflectionNamedType $firstType, ReflectionNamedType $secondType)
    {
        $type = $secondType->getName();
        $secondObject = new $type();
        return $firstType->getName() === 'array' && $secondObject instanceof Entity;
    }

    final public function mapArrayValue($name, $keyField)
    {
        if(!is_array($this->$name)) {
            //TODO: Exception
            throw new Exception();
        }
        $newAr = [];
        foreach($this->$name as $value) {
            $newAr[$value->$keyField] = $value;
        }
        $this->$name = $newAr;
    }

    final public function toArray(): array
    {
        foreach($this->getProperties() as $property) {
            $name = $property->getName();
            if(is_array($this->$name) && $property->getType() instanceof ReflectionUnionType) {
                //TODO: second type is instance of Entity
            }
        }
        return [];
    }

    /**
     * @return ReflectionProperty[]
     */
    private function getProperties(): array
    {
        return (new ReflectionClass($this))->getProperties();
    }
}