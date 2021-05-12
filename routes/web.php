<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\DiceController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\YatzyController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\HighscoreController;
use App\Http\Controllers\BlogController;
// use App\Http\Controllers\MainController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', [HelloWorldController::class, 'hello']);
// Route::get('/', function () {
//     return view('welcome'); //welcome är namnet på en vy
// });
// Route::get('/', [HelloWorldController::class, 'hello']);
Route::get('/', function () {
    Session::put('name', 'your2name');
    // echo Session::get('name');
    // $_SESSION["hi"] = "arg";
    return view('frontpage'); //frontpage är namnet på en vy
});
Route::get('/greeting', function () {
    return "hej hej";
});

Route::get("/dice", [DiceController::class, 'dicepage']);
// Route::post("/dice", array('as' => 'roll', 'uses' => 'DiceController@dicepage'));
Route::post("/dice", 'App\Http\Controllers\DiceController@dicepage');

Route::get("/game", [GameController::class, 'index']);
Route::post("/game", 'App\Http\Controllers\GameController@gamelogic');


Route::get("/yatzy", [YatzyController::class, 'index']);
Route::post("/yatzy", 'App\Http\Controllers\YatzyController@gameActions');


// Added for mos example code
// har ingen vy är bara echo
Route::get('/hello-world', function () {
    echo "Hello World";
});

Route::get('/hello-world-view', function () {
    return view('message', [
        'message' => "Hello World from within a view"
    ]);
});
Route::get('/hello', [HelloWorldController::class, 'hello']);
Route::get('/hello/{message}', [HelloWorldController::class, 'hello']);

Route::resource('/book', BooksController::class);
Route::resource('/highscore', HighscoreController::class);

Route::get("/blog/admin", 'App\Http\Controllers\BlogController@admin');
Route::resource("/blog", BlogController::class);
