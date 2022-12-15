<?php

use Bot\Command\InvokeStepCommand;
use Bot\Command\RestartCommand;
use Bot\Command\Worker\InvokeStepWorker;
use Bot\Command\Worker\RestartWorker;
use Bot\Config\QuestConfig;
use Bot\DI\ServiceLocator;
use Bot\Mode\Quest\QuestRunWorker;
use Bot\Mode\QuestMode;
use Bot\Service\HttpClientService;
use Bot\Service\Hydrator\DTOHydrator;
use Bot\Service\HydratorService;
use Bot\Service\Logger\FSLogger;
use Bot\Service\LoggerService;
use Bot\Service\QuestProgressService;
use Bot\Service\StashService;

return [
    LoggerService::class => fn () => new LoggerService(new FSLogger()),

    HttpClientService::class => fn () => new HttpClientService(
        new GuzzleHttp\Client(),
        ServiceLocator::get(LoggerService::class)
    ),

    StashService::class => fn () => new StashService(),

    HydratorService::class => fn () => new HydratorService(new DTOHydrator()),

    QuestProgressService::class => fn () => new QuestProgressService(
        ServiceLocator::get(StashService::class)
    ),

    QuestMode::class => fn () => new QuestMode(new QuestRunWorker(
        new QuestConfig(),
        ServiceLocator::get(HttpClientService::class),
        ServiceLocator::get(QuestProgressService::class),
    )),

    RestartCommand::class => fn () => new RestartCommand(new RestartWorker(
        new QuestConfig(),
        ServiceLocator::get(HttpClientService::class),
        ServiceLocator::get(QuestProgressService::class),
    )),

    InvokeStepCommand::class => fn () => new InvokeStepCommand(new InvokeStepWorker(
        new QuestConfig(),
        ServiceLocator::get(HttpClientService::class),
        ServiceLocator::get(QuestProgressService::class),
    )),
];