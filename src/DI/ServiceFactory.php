<?php

namespace Bot\DI;

use Bot\DI\Exception\ServiceNotDefinedException;

final class ServiceFactory
{
    public function __construct(
        protected array $services
    ) {
    }

    /**
     * @param string $className
     * @return mixed
     * @throws ServiceNotDefinedException
     */
    public function create(string $className): mixed
    {
        if (!isset($this->services[$className])) {
            throw new ServiceNotDefinedException($className);
        }

        $serviceInvoke = $this->services[$className];

        if (is_callable($serviceInvoke)) {
            return $serviceInvoke();
        }

        return $serviceInvoke;
    }
}