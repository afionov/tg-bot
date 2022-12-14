<?php

namespace Bot\Mode\Quest\Answer;

class Answer implements AnswerInterface
{
    protected function __construct(
        protected string $buttonText,
        protected string $stepIdToMove
    ) {
    }

    public static function createFromDTO(\Bot\Mode\Quest\DTO\Answer $answer): Answer
    {
        return new Answer($answer->value, $answer->move);
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