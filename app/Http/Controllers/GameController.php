<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Rilr\Dice\Game;
use Session;
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

        return view('gameStart', $data);
        // $body = renderView("layout/dice.php", $data);

        // return $psr17Factory
        //     ->createResponse(200)
        //     ->withBody($psr17Factory->createStream($body));
    }
    public function gamelogic() {
        $callable = unserialize(Session::get("game"));

        $data = ["header" => "hi", "message" => "hej"];
        $view = "gameStart";
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
            $view = "gamePlay";
        }
        return view($view, $data);
    }
}
