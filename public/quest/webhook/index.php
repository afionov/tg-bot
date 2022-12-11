<?php

use Bot\Bot;
use Bot\Config\BotConfig;
use Bot\Config\QuestConfig;
use Bot\Service\HttpClientService;
use Bot\Mode\QuestMode;
use GuzzleHttp\Client;

require_once realpath(__DIR__ . '/../../../') . '/vendor/autoload.php';

$token = (new BotConfig())->token;
$httpClient = new Client();

$questMode = new QuestMode(new QuestConfig, new HttpClientService($token, $httpClient));

$bot = new Bot($token, $questMode);
$bot->handleWebhook();