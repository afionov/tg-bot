<?php

namespace Bot\Entity\Helper;

use Bot\Entity\Entity;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;

final class Hydrator
{
    /**
     * @param Entity|string $entity
     * @param array $source
     * @return Entity
     * @throws ReflectionException
     */
    public static function hydrate(Entity|string $entity, array $source): Entity
    {
        $reflectionClass = new ReflectionClass($entity);
        if(is_string($entity)) {
            $entity = $reflectionClass->newInstanceWithoutConstructor();
        }
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            $name = $property->getName();
            if (!isset($source[$name])) {
                continue;
            }
            $type = $property->getType();
            $type instanceof ReflectionNamedType
                ? $this->fillEntityPropertyWithNamedType($type, $name, $data[$name])
                : $this->fillEntityPropertyWithUnionType($type, $name, $data[$name]);
        }
        return $entity;
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

    /**
     * @throws ReflectionException
     */
    public static function hydrateFromRequest(Entity|string $entity): Entity
    {
        $requestData = file_get_contents('php://input');
        return self::hydrate(
            $entity,
            json_decode($requestData, true)
        );
    }
}