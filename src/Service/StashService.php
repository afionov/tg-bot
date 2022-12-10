<?php

namespace Bot\Service;

class StashService
{
    public function init(string $name): StashService
    {
        return new static();
    }

    public function load(string $name): StashService
    {

    }

    public function __construct()
    {
    }
}