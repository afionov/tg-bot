<?php

namespace Bot\Entity\Helper;

use Bot\Entity\Entity;
use Bot\Entity\Exception\InvalidEntityException;
use Bot\Entity\Exception\RequiredValueException;
use Bot\Entity\Exception\UnsupportedTypeException;
use Bot\Entity\Helper\Attribute\AttributeInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

final class Hydrator
{
    /**
     * @param Entity|string $entity
     * @param array $source
     * @return Entity
     * @throws InvalidEntityException
     * @throws ReflectionException
     */
    public static function hydrate(Entity|string $entity, array $source): Entity
    {
        $reflectionClass = new ReflectionClass($entity);

        if (is_string($entity)) {
            $entity = $reflectionClass->newInstanceWithoutConstructor();
        }

        foreach ($reflectionClass->getProperties() as $property) {
            $name = $property->getName();

            try {
                $entity->$name = self::hydrateProperty($property, $source['name']);
            } catch (UnsupportedTypeException|RequiredValueException $e) {
                throw new InvalidEntityException($entity::class, $e->getMessage());
            }
        }

        return $entity;
    }

    /**
     * @param Entity|string $entity
     * @return Entity
     * @throws InvalidEntityException
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

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @return mixed
     * @throws InvalidEntityException
     * @throws ReflectionException
     * @throws UnsupportedTypeException
     */
    protected static function hydrateProperty(ReflectionProperty $property, mixed $value): mixed
    {
        $type = $property->getType();

        if (!$type instanceof ReflectionNamedType) {
            throw new UnsupportedTypeException($property->getName());
        }

        $propertyAttributes = $property->getAttributes();

        if (!empty($propertyAttributes)) {
            return self::hydratePropertyByAttributes($propertyAttributes, $value);
        }

        if ($type->isBuiltin()) {
            return $value;
        }

        $typeName = $type->getName();
        $entity = new $typeName();

        return self::hydrate($entity, $value);
    }

    /**
     * @param array $attributes
     * @param mixed $value
     * @return mixed
     */
    protected static function hydratePropertyByAttributes(array $attributes, mixed $value): mixed
    {
        $propertyValue = $value;

        /**
         * @var ReflectionAttribute $attribute
         */
        foreach ($attributes as $attribute) {
            if (!$attribute->getName() instanceof AttributeInterface) {
                continue;
            }

            $propertyValue = $attribute->newInstance()
                ->getWorker()
                ->handle($propertyValue);
        }

        return $propertyValue;
    }
}