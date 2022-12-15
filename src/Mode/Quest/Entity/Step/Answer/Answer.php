<?php

namespace Bot\Mode\Quest\Entity\Step\Answer;

class Answer implements AnswerInterface
{
    protected function __construct(
        protected string $buttonText,
        protected string $stepIdToMove
    ) {
    }

    public static function fromArray(array $array): Answer
    {
        return new Answer($array['value'], $array['move']);
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    public function getStepIdToMove(): string
    {
        return $this->stepIdToMove;
    }
}