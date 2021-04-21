<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Rilr\Dice\Game;
use Session;
use SessionHandler;

class GameController extends Controller
{

    public function index()
    {
        //$psr17Factory = new Psr17Factory();
        // var_dump($_SESSION);
        if (Session::get('game') == null) {
            $callable = new Game();
            Session::put("game", serialize($callable));
        }
        $callable = unserialize(Session::get("game"));



        // var_dump($data);
        // $data = [
        //     "header" => "Rainbow page",
        //     "message" => "Hey, edit this to do it youreself!",
        // ];
        $data = $callable->initGame();

        return view('gamestart', $data);
        // $body = renderView("layout/dice.php", $data);

        // return $psr17Factory
        //     ->createResponse(200)
        //     ->withBody($psr17Factory->createStream($body));
    }
    public function gamelogic() {
        $callable = unserialize(Session::get("game"));

        $data = ["header" => "hi", "message" => "hej"];
        $view = "gamestart";
        // $gameOption = Input::get('gameaction');
        // var_dump($_POST);
        if (isset($_POST["options"])) {
            switch ($_POST["options"]) {
                case 1:
                    // echo "en tärning";
                    $data = $callable->playGame(1);
                    break;

                case 2:
                    // echo "två tärningar";
                    $data = $callable->playGame(2);
                    break;
            }
            $view = "gameplay";
        } else if (isset($_POST["gameAction"])) {
            switch ($_POST["gameAction"]) {
                case "roll":
                    // $player = unserialize($_SESSION["player"]);
                    $player = unserialize(Session::get("player"));
                    // $data = $callable->playerRoll($player, $_POST["player"], $_POST["computer"], $_SESSION["computerDice"]);
                    $data = $callable->playerRoll($player, $_POST["player"], $_POST["computer"], Session::get("computerDice"));
                    $view = "gameplay";

                    break;

                case "stay":
                    // $computer = unserialize($_SESSION["computer"]);
                    $computer = unserialize(Session::get("computer"));
                    // computer does its thing :D
                    // $data = $callable->computerRoll($computer, $_POST["computer"], $_POST["player"]);
                    $data = $callable->computerRoll($computer, $_POST["computer"], $_POST["player"]);
                    // annan vy
                    $view = "gameintermission";
                    break;
                case "reset":
                    // unset($_SESSION["computerDice"]);
                    Session::forget("computerDice");
                    // if (!isset($_SESSION["game"])) {
                    if(Session::get("game") == null) {
                        $callable = new Game();
                        // $_SESSION["game"] = serialize($callable);
                        Session::put("game", serialize($callable));
                    }
                    // $callable = unserialize($_SESSION["game"]);
                    $callable = unserialize(Session::get("game"));
                    $data = $callable->initGame();
                    $view = "gamestart";
                    break;
                case "resetscore":
                    // echo "reset score     ";
                    // $_SESSION["resultArray"] = [];
                    Session::put("resultArray", []);
                    if (Session::get("game") == null) {
                        $callable = new Game();
                        // $_SESSION["game"] = serialize($callable);
                        Session::put("game", serialize($callable));
                    }
                    // $callable = unserialize($_SESSION["game"]);
                    $callable = unserialize(Session::get("game"));
                    $data = $callable->initGame();
                    $view = "gamestart";
                    break;
            }
        }
        return view($view, $data);
    }
}
