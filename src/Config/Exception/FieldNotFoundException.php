<?php

namespace Bot\Config\Exception;

use Exception;

class FieldNotFoundException extends Exception
{
    public function __construct(string $fieldName, string $configClassName)
    {
        parent::__construct('Поле `' . $fieldName . '` не найдено в ' . $configClassName);
    }
}