<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Rilr\Yatzy\Yatzy;
use Session;

class YatzyController extends Controller
{
    public function index()
    {
        $this->resetGame();
        $yatzy = new Yatzy();
        $data = $yatzy->startYatzy();
        Session::put("yatzy", serialize($yatzy));

        return view("yatzy", $data);
    }

    private function resetGame()
    {
        Session::forget("throws");
        Session::forget("playerScore");
        Session::forget('end');
        Session::forget('totalScore');
    }

    public function gameActions()
    {
        $yatzy = unserialize(Session::get("yatzy"));
        $data = [];

        if ($_POST["gameaction"] == "roll" && Session::get("throws") != 3) {
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

        if (Session::get('end') == true) {
            $data["totalScore"] = Session::get('totalScore');
            $this->resetGame();
            $view = 'yatzyscore';
        } else {
            $view = 'yatzy';
        }

        return view($view, $data);
    }
}
