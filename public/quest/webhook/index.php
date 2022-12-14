<?php

use Bot\Bot;
use Bot\Config\BotConfig;

require_once realpath(__DIR__ . '/../../../') . '/vendor/autoload.php';

$bot = new Bot(new BotConfig());
$bot->handleWebhook();