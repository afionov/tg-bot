<?php

use Bot\Config\QuestConfig;
use Bot\DI\ServiceLocator;
use Bot\Mode\QuestMode;
use Bot\Service\HttpClientService;
use Bot\Service\Hydrator\DTOHydrator;
use Bot\Service\HydratorService;
use Bot\Service\Logger\FSLogger;
use Bot\Service\LoggerService;
use Bot\Service\StashService;

return [
    LoggerService::class => fn () => new LoggerService(new FSLogger()),

    HttpClientService::class => fn () => new HttpClientService(
        new GuzzleHttp\Client(),
        ServiceLocator::get(LoggerService::class)
    ),

    StashService::class => fn () => new StashService(),

    HydratorService::class => fn () => new HydratorService(new DTOHydrator()),

    QuestMode::class => fn () => new QuestMode(
        new QuestConfig(),
        ServiceLocator::get(HttpClientService::class),
        ServiceLocator::get(StashService::class),
        ServiceLocator::get(LoggerService::class),
        ServiceLocator::get(HydratorService::class)
    )
];