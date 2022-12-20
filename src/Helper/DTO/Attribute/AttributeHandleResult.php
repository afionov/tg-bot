<?php

namespace Bot\Helper\DTO\Attribute;

final class AttributeHandleResult
{
    /**
     * @var bool
     */
    protected bool $valid = true;

    /**
     * @var mixed|null
     */
    protected mixed $result = null;

    /**
     * @var string[]
     */
    protected array $errors = [];

    /**
     * @param string $message
     * @return void
     */
    public function addError(string $message): void
    {
        $this->valid = false;
        $this->errors[] = $message;
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getErrorsAsString(): string
    {
        return implode('; ', $this->getErrors());
    }

    /**
     * @param mixed $result
     * @return void
     */
    public function setResult(mixed $result): void
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getResult(): mixed
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->valid;
    }
}