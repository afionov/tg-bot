<?php

namespace Bot\Mode\Quest;

use Bot\Mode\Quest\Button\Format\ButtonFormatStrategy;

final class StepCollection
{
    public static function createFromArray(array $array, ButtonFormatStrategy $buttonFormatStrategy): StepCollection
    {
        $result = [];

        foreach ($array as $value) {
            if (!$value instanceof Entity\Step) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Array item %s must be an instance of %s',
                        json_encode($value),
                        Step::class
                    )
                );
            }

            $result[$value->id] = Step::fromEntity($value, $buttonFormatStrategy);
        }

        return new StepCollection($result);
    }

    public function getStepById(string|int $id): ?Step
    {
        return $this->collection[$id];
    }

    protected function __construct(
        protected array $collection
    ) {
    }
}