<?php

namespace Bot\Helper\DTO\Hydrator;

use Bot\DTO\DTO;
use Bot\Helper\DTO\Attribute\AttributeHandleResult;
use Bot\Helper\DTO\Attribute\AttributeInterface;
use Bot\Helper\DTO\Hydrator\Exception\AttributeValidationException;
use Bot\Helper\DTO\Hydrator\Exception\InternalClassException;
use Bot\Helper\DTO\Hydrator\Exception\InvalidDTOException;
use Bot\Helper\DTO\Hydrator\Exception\PropertyTypeException;
use Bot\Helper\DTO\Hydrator\Exception\UndefinedDTOException;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionException;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionProperty;
use ReflectionUnionType;

final class Hydrator
{
    /**
     * @param DTO|class-string<DTO> $hydratable
     * @param array $source
     * @return DTO
     * @throws UndefinedDTOException
     * @throws InternalClassException
     * @throws InvalidDTOException
     * @throws AttributeValidationException
     */
    public static function hydrate(DTO|string $hydratable, array $source): DTO
    {
        try {
            $reflectionClass = new ReflectionClass($hydratable);
        } catch (ReflectionException) {
            throw new UndefinedDTOException($hydratable);
        }

        if (is_string($hydratable)) {
            try {
                $hydratable = $reflectionClass->newInstanceWithoutConstructor();
            } catch (ReflectionException) {
                throw new InternalClassException($reflectionClass->getName());
            }
        }

        foreach ($reflectionClass->getProperties() as $property) {
            $name = $property->getName();

            if (!isset($source[$name])) {
                continue;
            }

            try {
                $hydratable->$name = self::hydrateProperty($property, $source[$name]);
            } catch (PropertyTypeException $e) {
                throw new InvalidDTOException($hydratable::class, $e->getMessage());
            }
        }

        return $hydratable;
    }

    /**
     * @param ReflectionProperty $property
     * @param mixed $value
     * @return mixed
     * @throws AttributeValidationException
     * @throws InternalClassException
     * @throws PropertyTypeException
     * @throws UndefinedDTOException
     * @throws InvalidDTOException
     */
    protected static function hydrateProperty(ReflectionProperty $property, mixed $value): mixed
    {
        $type = $property->getType();

        if (!$type instanceof ReflectionNamedType) {
            /**
             * @var ReflectionUnionType|ReflectionIntersectionType|null $type
             */
            throw new PropertyTypeException($property->getName(), $type);
        }

        $propertyAttributes = $property->getAttributes();

        if (!empty($propertyAttributes)) {
            return self::hydratePropertyByAttributes($propertyAttributes, $value);
        }

        if ($type->isBuiltin()) {
            return $value;
        }

        $typeName = $type->getName();

        /**
         * @var class-string<DTO> $typeName
         * @var array $value
         */
        return self::hydrate($typeName, $value);
    }

    /**
     * @param ReflectionAttribute[] $attributes
     * @param mixed $value
     * @return mixed
     * @throws AttributeValidationException
     */
    protected static function hydratePropertyByAttributes(array $attributes, mixed $value): mixed
    {
        $result = new AttributeHandleResult();

        foreach ($attributes as $attribute) {
            $attributeInstance = $attribute->newInstance();

            if (!$attributeInstance instanceof AttributeInterface) {
                continue;
            }

            $value = $attributeInstance->handleValue($value, $result);

            if (!$result->isValid()) {
                throw new AttributeValidationException(
                    $attribute->getName(), $result->getErrorsAsString()
                );
            }
        }

        return $value;
    }
}