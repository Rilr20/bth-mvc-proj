<?php

declare(strict_types=1);

namespace Rilr\Dice;

use Rilr\Dice\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    /**
     * @var array $dices array that gets filled with Dice instances 
     */ 
    private $dices = [];
    /**
     * constructor that creates a die and puts it inside $dices
     * @param int $numOfDice How many dice instaances there will be created
     * @param int $sides how many sides the dice should have
     */
    public function __construct($numOfDice, $sides)
    {
        for ($i = 0; $i < $numOfDice; $i++) {
            $this->dices[$i] = new Dice($sides);
        }
    }

    /**
     * Throws the all the dice in the dices array
     * @return void 
     */
    public function throw(): void
    {
        $len = sizeOf($this->dices);
        for ($i = 0; $i < $len; $i++) {
            $this->dices[$i]->throw();
        }
    }

    /**
     * adds the recent throws inside an array
     * @return array of the values of all dice
     */
    public function getLastRoll(): array
    {
        // $returnString = "";
        $len = sizeOf($this->dices);
        $returnArray = [];
        for ($i = 0; $i < $len; $i++) {
            $dieRoll = $this->dices[$i]->getLastRoll();
            // $returnString = (string)$returnString . " " . (string)$dieRoll;
            $returnArray[$i] = $dieRoll;
        }
        // $returnString = $returnArray;
        return $returnArray;
    }
    /**
     * @return int the length of the $dices array
     */
    public function getDiceHandLenght(): int
    {
        return count($this->dices);
    }
}
