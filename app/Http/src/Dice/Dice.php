<?php

declare(strict_types=1);

namespace Rilr\Dice;

/**
 * Class Dice.
 */
class Dice
{
    /**
     * @var int $sides Number of sides on the Dice
     * @var int $sides Saves the last throw value of the dice
     */
    public int $sides;
    private int $latestThrow = 0;
    /**
     * @param int $sides get function
     */
    public function __construct($sides)
    {
        $this->sides = $sides;
    }
    /**
     * Gets a random number depending on dice sides
     * @return void
     */
    public function throw(): void
    {
        $this->latestThrow = rand(1, $this->sides);
        // return $this->latestThrow;
    }
    /**
     * @return int returns the last thrown value of the dice
     */
    public function getLastRoll(): int
    {
        return $this->latestThrow;
    }
}
