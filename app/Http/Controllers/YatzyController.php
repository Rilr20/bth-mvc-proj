<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Rilr\Yatzy\Yatzy;
use Session;
use SessionHandler;

class YatzyController extends Controller
{
    public function index() {
        $this->resetGame();
        $yatzy = new Yatzy();
        $data = $yatzy->startYatzy();
        Session::put("yatzy", serialize($yatzy));

        return view("yatzy", $data);
    }

    private function resetGame() {
        Session::forget("throws");
        Session::forget("playerScore");
    }

    public function gameActions() {
        $yatzy = unserialize(Session::get("yatzy"));
        $data = [];

        if($_POST["gameaction"] == "roll" && Session::get("throws") != 3) {
            $data = $yatzy->diceReturn();
            $throws = Session::get("throws") + 1;
            Session::put("throws", $throws);
        } else if ($_POST["gameaction"] == "reroll" && Session::get("throws") != 3 && isset($_POST["chosenDice"])) {
            $data = $yatzy->reroll($_POST["chosenDice"]);
            $throws = Session::get("throws") + 1;
            Session::put("throws", $throws);
        } else if (isset($_POST["gameaction"])) {
            $data = $yatzy->addScore($_POST["Dice"]);
            Session::put("throws", 0);
        }

        return view("yatzy", $data);
    }
}
