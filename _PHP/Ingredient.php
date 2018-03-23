<?php

namespace Ingredient;

class Ingredient
{
    protected $name;
    protected $cost;

    public function getName(): string
    {
        return $this->name;
    }

    public function getCost(): float
    {
        return $this->cost;
    }

    public function changeCost(float $newCost = 0): bool
    {
        if ($this->cost = $newCost)
            return true;

        return false;
    }

    public function __construct(string $name = '', float $cost = 0)
    {
        $this->name = $name;
        $this->cost = $cost;
    }
}