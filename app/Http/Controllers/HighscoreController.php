<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Highscores;

class HighscoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $highscore = Highscores::all()
            ->sortByDesc('score')
            ->take(10);
            // ->get();

        return view('highscore', [
            'highscore' => $highscore
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('yatzyScore')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        // $highscore = new Highscores();
        // $highscore->username = $request->input('username');
        // $highscore->score = $request->input('totalscore');
        // $highscore->achieved = now();
        // $highscore->save();

        $highscore = Highscores::create([
            'username' => $request->input('username'),
            'score' => $request->input('totalscore'),
            'achieved' => now()
        ]);

        return redirect("/highscore");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
