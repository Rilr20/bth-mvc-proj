<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Rilr\Dice\Dice;

class DiceController extends Controller
{
    public function dicepage()
    {
        $dice = new dice(6);
        $dice->throw();
        return view('gameboard', [
            'title' => "Tärning",
            'result' => $dice->getLastRoll()
        ]);
    }
}
