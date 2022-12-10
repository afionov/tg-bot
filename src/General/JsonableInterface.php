<?php

namespace Bot\General;

interface JsonableInterface
{
    public function toJson(int $parameters): string;
}