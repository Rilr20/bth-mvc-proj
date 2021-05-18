<?php

declare(strict_types=1);

namespace Rilr\Dice;

use DateTime;
use Session;
// use Illuminate\Support\Facades\Session;
use Rilr\Dice\DiceHand;
use Rilr\Dice\GraphicalDice;

// use function Mos\Functions\{
//     destroySession,
//     redirectTo,
//     renderView,
//     renderTwigView,
//     sendResponse,
//     url
// };

/**
 * Class Game
 */
class Game
{
    /**
     * @var object $player is a instance of DiceHand class
     * @var object $computer is a instance of DiceHand class
     * @var int $sides
     */
    public $player;
    public $computer;
    public $sides = 6;

    /**
     * The function that starts the game. Calls the first round function
     * @param int $numOfDie how many dice the player will have 
     * @return array key value array is returned.
     */
    public function playGame($numOfDie = 1)
    {
        // $_SESSION["running"] = "true";
        Session::put("running", "true");
        $data = [
            "title" => "Game 21",
            "header" => "Game 21",
            "message" => "Roll the die and get as close to 21 but not over it!"
        ];
        // creates player and computer hands
        // $playerHand = new DiceHand(2, 6);
        // var_dump($numOfDie);
        $this->player = new DiceHand($numOfDie, $this->sides);
        $this->computer = new DiceHand($numOfDie, $this->sides);
        // $computerHand = new DiceHand(2, 6);
        // $die = new Dice(6);
        // $die->throw();

        //throws dice
        $newData = $this->firstRound($this->player, $this->computer);
        $data = array_merge($data, $newData);
        // $res = $this->dieSum($computerHand->getLastRoll());
        // $data["dielastRoll"] = $res;
        // $res = $this->dieSum($playerHand->getLastRoll());
        // $data["diceHandRoll"] = $res;

        //creates data for router
        // $data["debug_sesion"] = $_SESSION;
        // var_dump($data);
        // $_SESSION["player"] = serialize($this->player);
        Session::put("player", serialize($this->player));
        // $_SESSION["computer"] = serialize($this->computer);
        Session::put("computer", serialize($this->computer));

        return $data;
        // $body = renderView("layout/dice.php", $data);
        // sendResponse($body);
    }

    /**
     * calculates the sum inside the dice array
     * @param array $diceArray array of intergers
     * @return int calculated sum of the numbers in the $diceArray
     */
    private function dieSum($diceArray): int
    {
        //ska ha föregående kast resultat
        $dieSum = 0;
        foreach ($diceArray as $die) {
            $dieSum = $dieSum + $die;
        }
        return $dieSum;
    }
    /**
     * returns an array of html code based on the inputed dice array
     * @param array $diceArray array of intergers
     * @return array returns array of html code
     */
    private function renderDice($diceArray): array
    {
        $htmlArray = [];
        $render = new GraphicalDice(6);
        foreach ($diceArray as $dice) {
            $dice = $render->renderDice($dice);
            array_push($htmlArray, $dice);
        }
        return $htmlArray;
    }
    /**
     * the first round of the game, player and computer rolls the die
     * @param object $playerHand DiceHand object
     * @param object $computerHand DiceHand object
     * @return array returns a key value array
     */
    private function firstRound($playerHand, $computerHand): array
    {
        $playerDice = [];
        $computerDice = [];
        $data = [
            "title" => "Game 21",
        ];

        // roll dice
        $playerHand->throw();
        $computerHand->throw();
        // get rolls
        $res = $this->dieSum($computerHand->getLastRoll());
        $computerDice = $this->renderDice($computerHand->getLastRoll());
        $data["computerSum"] = $res;
        $data["computerDice"] = $computerDice;

        $res = $this->dieSum($playerHand->getLastRoll());
        $playerDice = $this->renderDice($playerHand->getLastRoll());
        $data["playerRoll"] = $res;
        $data["playerDice"] = $playerDice;

        return $data;
    }
    /**
     * initiates the game returns a basic key value array for output
     * @return array returns a key value array
     */
    public function initGame(): array
    {
        // $_SESSION["running"] = "false";
        Session::put("running", "false");
        $data = [
            "title" => "Game 21",
            "header" => "Game 21",
            "message" => "Roll the die and get as close to 21 but not over it!"
        ];

        return $data;
        // $body = renderView("layout/dice.php", $data);
        // sendResponse($body);
    }
    /**
     * player rolls the dice
     * @param object $playerHand DiceHand object
     * @param int $currentSum sum of players points
     * @param int $opponentSum sum of opponents points
     * @param string $computerDice html code of $computerDice
     * @return array returns a key value array
     */
    public function playerRoll($playerHand, $currentSum, $opponentSum, $computerDice)
    {
        //rendera tärningar
        // var_dump($computerDice);
        $newSum = 0;
        $playerHand->throw();
        $sumArray = $playerHand->getLastRoll();
        foreach ($sumArray as $roll) {
            $newSum = $newSum + $roll;
        }
        $newSum = $newSum + $currentSum;
        $playerDice = $this->renderDice($playerHand->getLastRoll());
        $computerDice = unserialize($computerDice);
        $data = [
            "title" => "Game 21",
            "header" => "Game 21",
            "message" => "Hey!",
            "computerSum" => $opponentSum,
            "playerRoll" => $newSum,
            "computerDice" => $computerDice,
            "playerDice" => $playerDice
        ];
        // $body = renderView("layout/dice.php", $data);
        // sendResponse($body);
        return $data;
    }
    /**
     * Checks the win condition based on the player and computer sum
     * @param int $playerSum sum of players points
     * @param int $computerSum sum of opponents points
     * @param array $htmlArray html code for opponents dice
     * @return array returns a key value array
     */
    public function checkWinCondition($playerSum, $computerSum, $htmlArray)
    {
        $string = "";
        $pWin = "Player Wins!";
        $pLoss = "Player Loses!";
        // $_SESSION["resultArray"] = $_SESSION["resultArray"] ?? [];
        $array = Session::get("resultArray") ?? [];
        Session::put("resultArray", $array);
        // if (!isset($_SESSION["resultArray"])) {
        //     $_SESSION["resultArray"] = [];
        // }
        $newResult = [];
        if ($computerSum == 21) {
            $string = $pLoss; //"datorn har 21 förlust"; // funkar $pLoss
        } else if ($playerSum == 21) {
            $string = $pWin; //"spelaren har 21 vinst"; // funkar $pWin
        } else if ($playerSum > 21) {
            $string = $pLoss; //"spelaren har över 21 förlust"; // funkar $pLoss
        } else if ($computerSum > 21) {
            $string = $pWin; //"datorn har över 21 vinst"; // funkar $pWin
        } else if ($computerSum > $playerSum && $computerSum < 21) {
            $string = $pLoss; //"datorn har högre än spelaren och mindre än 21 förlust"; // funkar $pLoss
        } else if ($playerSum > $computerSum && $playerSum < 21) {
            $string = $pWin; //"spelaren har högre än datorn men mindre än 21 Vinst"; // funkar $pWin
        } else if ($playerSum == $computerSum) {
            $string = $pLoss; //spelaren och datorn har lika mycket, förlust
        }
        $data = [
            "title" => "Game 21",
            "header" => "Game 21",
            "message" => "Roll the die and get as close to 21 but not over it!",
            "computerSum" => $computerSum,
            "playerRoll" => $playerSum,
            "gameText" => $string,
            "playerDice" => [],
            "computerDice" => $htmlArray
        ];
        // return $data;
        $currentDate = new DateTime();
        // echo $currentDate->format('Y-m-d H:i:s');
        $string = $string . " " . $currentDate->format('Y-m-d H:i:s');
        $newResult[0] = $string;
        // $_SESSION["resultArray"] = array_merge($_SESSION["resultArray"], $newResult);
        Session::put("resultArray", array_merge(Session::get("resultArray"), $newResult));
        // $_SESSION["running"] = "intermission";
        Session::put("running", "intermission");
        // $body = renderView("layout/dice.php", $data);
        // sendResponse($body);
        return $data;
    }
    /**
     * Computer rolls the dice then calls checkWinCondition
     * @param object $computerHand instance of DiceHand class
     * @param int $computerSum sum of opponents points 
     * @param int $playerSum sum of players points 
     * @return array key Value array
     */
    public function computerRoll($computerHand, $computerSum, $playerSum)
    {
        //rendera tärningar
        $newSum = $computerSum;
        $htmlArray = [];
        if ($playerSum <= 21) {
            while ($newSum <= 16) {
                $computerHand->throw();

                $sumArray = $computerHand->getLastRoll();
                foreach ($sumArray as $roll) {
                    $newSum = $newSum + $roll;
                }
                $renderDice = $this->renderDice($sumArray);
                $htmlArray = array_merge($htmlArray, $renderDice);
            }
        }
        return $this->checkWinCondition($playerSum, $newSum, $htmlArray);
    }
}
