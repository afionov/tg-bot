<?php

namespace Bot\Service\Hydrator;

use Bot\DTO\DTO;
use Bot\Service\Hydrator\DTOHydrator\Attribute\AttributeInterface;
use Bot\Service\Hydrator\DTOHydrator\Exception\InvalidDTOException;
use Bot\Service\Hydrator\DTOHydrator\Exception\UnsupportedTypeException;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionProperty;

final class DTOHydrator implements HydratorInterface
{
    /**
     * @param HydratableInterface|string $hydratable
     * @param array $source
     * @return DTO
     * @throws InvalidDTOException
     * @throws ReflectionException
     */
    public function hydrate(HydratableInterface|string $hydratable, array $source): DTO
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
                throw new InvalidDTOException($hydratable::class, $e->getMessage());
            }
        }

        return $hydratable;
    }

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @return mixed
     * @throws InvalidDTOException
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
        $dto = new $typeName();

        return $this->hydrate($dto, $value);
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