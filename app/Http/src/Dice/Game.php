<?php

declare(strict_types=1);

namespace Rilr\Dice;

use DateTime;
use Session;
// use Illuminate\Support\Facades\Session;
use Rilr\Dice\{
    Dice,
    DiceHand,
    GraphicalDice
};

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
    public $player;
    public $computer;
    public $sides = 6;
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

    private function dieSum($diceArray): int
    {
        //ska ha föregående kast resultat
        $dieSum = 0;
        foreach ($diceArray as $die) {
            $dieSum = $dieSum + $die;
        }
        return $dieSum;
    }
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
            $string = $pLoss;//"datorn har 21 förlust"; // funkar $pLoss
        } else if ($playerSum == 21) {
            $string = $pWin;//"spelaren har 21 vinst"; // funkar $pWin
        } else if ($playerSum > 21) {
            $string = $pLoss;//"spelaren har över 21 förlust"; // funkar $pLoss
        } else if ($computerSum > 21) {
            $string = $pWin;//"datorn har över 21 vinst"; // funkar $pWin
        } else if ($computerSum > $playerSum && $computerSum < 21) {
            $string = $pLoss; //"datorn har högre än spelaren och mindre än 21 förlust"; // funkar $pLoss
        } else if ($playerSum > $computerSum && $playerSum < 21) {
            $string = $pWin;//"spelaren har högre än datorn men mindre än 21 Vinst"; // funkar $pWin
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
