<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() 
    {
        return view('login.login', ['title' => 'Inloggning']);
    }

    public function checklogin(Request $request) 
    {
        // dd($request);
        $userData = array(
            'username' => $request->get('username'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($userData)) 
        {
            return redirect('blog/admin');
        }
        // else {
            // return back()->with('wrong', 'Fel inloggning');
        return view('login.login', ['wrong' => 'Fel inloggning', 'title' => 'Inloggning']);
        // }
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}