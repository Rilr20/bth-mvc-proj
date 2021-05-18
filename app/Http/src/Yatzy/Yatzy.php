<?php

declare(strict_types=1);

namespace Rilr\Yatzy;

use phpDocumentor\Reflection\PseudoTypes\True_;
use Session;
use Rilr\Dice\{
    DiceHand,
    GraphicalDice
};

/**
 * Class Yatzy.
 */
class Yatzy
{
    /**
     * @var object $player instance of DiceHand
     * @var array $playerScore scoretable for player
     * @var object $computer instance of DiceHand
     * @var array $computerScore scoretable for computer
     * @var array $recentDice the most recent throws
     * @var int DICEAMOUNT Amount of die in yatzy
     * @var int DICESIDES The amount of sides that has in yatzy
     * @var array TABLEDATA Rounds names in yatzy
     * @var array BORDER Adds a html class on these
     */
    public $player;
    public $playerScore;
    public $computer;
    public $computerScore;
    public $recentDice;
    const DICEAMOUNT = 5;
    const DICESIDES = 6;
    const TABLEDATA = ["Ones", "Twos", "Threes", "Fours", "Fives", "Sixes", "Sum", "Bonus", "Three of a kind", "Four of a kind", "Full House", "Small Straight", "Large Straight", "Chance", "Yatzy", "Total Score"];
    const BORDER = ["Sum", "Three of a kind", "Total Score"];

    /**
     * Creates a table with computer and players score
     * @param array $playerScore with ints that are players score 
     * @param array  $computerScore with ints that are computers score
     * @return array returns a key value array with the new table it creates
     */
    public function render($playerScore, $computerScore): array
    {
        $loopdata = "";
        $data = [
            "header" => "Yatzy page!",
            "message" => "Hello, this is the Yatzy page, rendered as a layout."
        ];
        $i = 0;
        $htmlClass = "<tr class='border'>";
        foreach (self::TABLEDATA as $row) {
            // if (in_array($row, self::BORDER)) {
            //     $loopdata = $loopdata . "<tr class='border'>";
            // } else {
            // }
            // $loopdata = $loopdata . "<tr>";
            in_array($row, self::BORDER) == true ? $loopdata .= $htmlClass : $loopdata .= "<tr>";
            // in_array($row, self::BORDER) == false ? 'true' : $loopdata = $loopdata . "<tr>";
            $loopdata = $loopdata . "<td>" . $row . "</td>";
            $loopdata = $loopdata . "<td>" . $playerScore[$i] . "</td>";
            $loopdata = $loopdata . "<td>" . $computerScore[$i] . "</td>";
            $loopdata = $loopdata . "</tr>";
            $i++;
        }
        $data["tabledata"] = $loopdata;
        return $data;
    }
    /**
     * Starts the game and creates dicehands for player and computer
     * @return array $data key value array
     */
    public function startYatzy(): array
    {
        $this->player = new DiceHand(self::DICEAMOUNT, self::DICESIDES);
        $this->computer = new DiceHand(self::DICEAMOUNT, self::DICESIDES);

        // $_SESSION["player"] = serialize($this->player);
        // $_SESSION["computer"] = serialize($this->computer);
        $this->computerScore = array_fill(0, 16, 0);
        $this->playerScore = $this->playerArray();
        $data = self::render($this->playerScore, $this->computerScore);
        // $_SESSION["throws"] = 0;
        Session::put("throws", 0);
        return $data;
    }
    /**
     * creates array for player
     */
    private function playerArray(): array
    {
        $playerScore = [];
        $nobox = [6, 7, 15];
        for ($i = 0; $i < 16; $i++) {
            $playerScore[$i] = "X";
            if (in_array($i, $nobox)) {
                // $playerScore[$i] = "<input type='radio' name='choice' value='" . $i ."'>";
                // array_push($playerScore, 0);
                $playerScore[$i] = 0;
            }
        }
        // array_push($playerScore, 0);
        return $playerScore;
    }
    /**
     * throws dice and adds it to diceArray
     * @return array $data key value array
     */
    public function diceReturn()
    {
        $this->player->throw();
        $this->recentDice = $this->player->getLastRoll();
        // $_SESSION["recentDice"] = $this->recentDice;
        Session::put("recentDice", $this->recentDice);
        if (Session::get("playerScore") == null) {
            // $_SESSION["playerScore"] = $this->playerScore;
            Session::put("playerScore", $this->playerScore);
        }

        // $this->playerScore = $_SESSION["playerScore"];
        $this->playerScore = Session::get("playerScore");
        $graphicalDice = new GraphicalDice(self::DICESIDES);
        $diceArray = [];
        foreach ($this->recentDice as $die) {
            array_push($diceArray, $graphicalDice->renderDice($die));
        }
        $data = $this->render($this->playerScore, $this->computerScore);
        $data["playerDice"] = $diceArray;
        return $data;
    }
    /**
     * function that rerolls the chosen die
     * @param array $chosendie array with the die you want to keep
     * @return array $data key value array
     */
    public function reroll($chosendie)
    {
        Session::put("recentDice", $this->recentDice);
        if (Session::get("playerScore") == null) {
            // $_SESSION["playerScore"] = $this->playerScore;
            Session::put("playerScore", $this->playerScore);
        }

        $this->playerScore = Session::get("playerScore");
        $difference = self::DICEAMOUNT - count($chosendie);
        $this->player->throw();
        $darray = $this->player->getLastRoll();
        $newArray = array_slice($darray, 0, $difference);
        $dicearray = array_merge($chosendie, $newArray);
        $graphicalDice = new GraphicalDice(self::DICESIDES);
        $dices = [];
        foreach ($dicearray as $die) {
            array_push($dices, $graphicalDice->renderDice($die));
        }
        $data = $this->render($this->playerScore, $this->computerScore);
        $data["playerDice"] = $dices;
        return $data;
    }
    /**
     * adds the score to the current round
     * @param int $diceScore of the score of current round
     * @return array calls render function which returns data array
     */
    public function addScore($diceScore)
    {
        // echo "function";
        // var_dump($diceScore);
        // var_dump($this->playerScore);
        // $this->playerScore = $_SESSION["playerScore"];
        $this->playerScore = Session::get("playerScore");
        $next = $this->getNextScore();
        // var_dump($this->playerScore);
        // var_dump($diceScore);
        switch ($next) {
            case 0:
                # add 1s
                $this->simpleAdds($diceScore, 1);
                break;
            case 1:
                # add 2s
                $this->simpleAdds($diceScore, 2);
                break;
            case 2:
                # add 3s
                $this->simpleAdds($diceScore, 3);
                break;
            case 3:
                # add 4s
                $this->simpleAdds($diceScore, 4);
                break;
            case 4:
                # add 5s
                $this->simpleAdds($diceScore, 5);
                break;
            case 5:
                # add 6s
                $this->simpleAdds($diceScore, 6);

                break;
        }
        $this->calculateSum();
        // $_SESSION["playerScore"] = $this->playerScore;
        if ($next == 5) {
            Session::put("end", true);
            Session::put("totalScore", $this->playerScore[6]);
        }
        Session::put("playerScore", $this->playerScore);
        return $this->render($this->playerScore, $this->computerScore);
        //gör arraysaker
        // var_dump($next);
    }

    /**
     * finds out what the next round is
     * @return int for the next round
     */
    private function getNextScore()
    {
        $i = 0;
        foreach ($this->playerScore as $score) {
            if ((string)$score == "X") {
                break;
            }
            $i++;
        }
        return $i;
    }
    /**
     * adds the sum of dices to the right round in $playerScore
     * @param array $dices array of dice numbers
     * @param int $number roundnumber
     * @return void
     */
    private function simpleAdds($dices, $number)
    {
        $sum = 0;
        foreach ($dices as $dice) {
            if ($dice == $number) {
                $sum = $sum + (int)$dice;
            }
        }
        // return $sum;
        $this->playerScore[$number - 1] = $sum;
    }
    /**
     * If score is 63 or more player gains bonus score
     * @param int $sum sum of all scores
     * @return void
     */
    private function bonusScore($sum)
    {
        if ($sum >= 63) {
            $this->playerScore[7] = 50;
        }
    }
    /**
     * calculates the sum on players scorecard
     * @return void
     */
    private function calculateSum()
    {
        $scoreTable = $this->playerScore;
        $totalSum = 0;
        for ($i = 0; $i < 6; $i++) {
            if ($scoreTable[$i] != "X") {
                $totalSum = $totalSum + $scoreTable[$i];
            }
        }
        $this->bonusScore($totalSum);
        $this->playerScore[6] = $totalSum;
    }
}
