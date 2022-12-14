<?php

use Bot\Bot;
use Bot\Config\BotConfig;
use Bot\Config\QuestConfig;
use Bot\Service\HttpClientService;
use Bot\Mode\QuestMode;
use Bot\Service\Hydrator\EntityHydrator;
use Bot\Service\HydratorService;
use Bot\Service\Logger\FSLogger;
use Bot\Service\LoggerService;
use Bot\Service\StashService;
use GuzzleHttp\Client;

require_once realpath(__DIR__ . '/../../../') . '/vendor/autoload.php';

$token = (new BotConfig())->token;
$httpClient = new Client();
$loggerService = new LoggerService(new FSLogger());

$questMode = new QuestMode(
    new QuestConfig,
    new HttpClientService($token, $httpClient, $loggerService),
    new StashService(),
    new LoggerService(new FSLogger()),
    new HydratorService(new EntityHydrator())
);

$bot = new Bot($token, $questMode);
$bot->handleWebhook();