<?php

namespace Bot\DI;

final class ServiceLocator
{
    protected array $services = [];

    protected const SERVICES_CONFIG_PATH = __DIR__ . '/../../config/services.php';

    protected ServiceFactory $serviceFactory;

    protected static ?ServiceLocator $instance = null;

    public static function init(): void
    {
        self::$instance = new ServiceLocator();
    }

    public static function get(string $className)
    {
        return self::$instance->getService($className);
    }

    protected function __construct()
    {
        $services = include self::SERVICES_CONFIG_PATH;
        $this->serviceFactory = new ServiceFactory($services);
    }

    protected function getService(string $className)
    {
        return $this->services[$className]
            ?? $this->services[$className] = $this->serviceFactory->create($className);
    }
}