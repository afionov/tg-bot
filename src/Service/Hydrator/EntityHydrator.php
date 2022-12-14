<?php

namespace Bot\Service\Hydrator;

use Bot\Entity\Entity;
use Bot\Entity\Exception\InvalidEntityException;
use Bot\Entity\Exception\UnsupportedTypeException;
use Bot\Service\Hydrator\EntityHydrator\Attribute\AttributeInterface;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

final class EntityHydrator implements HydratorInterface
{
    /**
     * @param HydratableInterface|string $hydratable
     * @param array $source
     * @return Entity
     * @throws InvalidEntityException
     * @throws ReflectionException
     */
    public function hydrate(HydratableInterface|string $hydratable, array $source): Entity
    {
        $reflectionClass = new ReflectionClass($hydratable);

        if (is_string($hydratable)) {
            $hydratable = $reflectionClass->newInstanceWithoutConstructor();
        }

        foreach ($reflectionClass->getProperties() as $property) {
            $name = $property->getName();

            if (!isset($source[$name])) {
                continue;
            }

            try {
                $hydratable->$name = $this->hydrateProperty($property, $source[$name]);
            } catch (UnsupportedTypeException $e) {
                throw new InvalidEntityException($hydratable::class, $e->getMessage());
            }
        }

        return $hydratable;
    }

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @return mixed
     * @throws InvalidEntityException
     * @throws ReflectionException
     * @throws UnsupportedTypeException
     */
    protected function hydrateProperty(ReflectionProperty $property, mixed $value): mixed
    {
        $type = $property->getType();

        if (!$type instanceof ReflectionNamedType) {
            throw new UnsupportedTypeException($property->getName());
        }

        $propertyAttributes = $property->getAttributes();

        if (!empty($propertyAttributes)) {
            return $this->hydratePropertyByAttributes($propertyAttributes, $value);
        }

        if ($type->isBuiltin()) {
            return $value;
        }

        $typeName = $type->getName();
        $entity = new $typeName();

        return $this->hydrate($entity, $value);
    }

    /**
     * @param array $attributes
     * @param mixed $value
     * @return mixed
     */
    protected function hydratePropertyByAttributes(array $attributes, mixed $value): mixed
    {
        $propertyValue = $value;
        /**
         * @var ReflectionAttribute $attribute
         */
        foreach ($attributes as $attribute) {
            $attributeInstance = $attribute->newInstance();

            if (!$attributeInstance instanceof AttributeInterface) {
                continue;
            }

            $propertyValue = $attributeInstance->getWorker()
                ->handle($propertyValue);
        }

        return $propertyValue;
    }
}