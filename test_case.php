<?php

use Bot\Command\CommandEnum;
use Bot\Command\CommandFactory;

require_once 'vendor/autoload.php';

$test = CommandFactory::make('asd', CommandEnum::StartCommand);
var_dump($test);die();