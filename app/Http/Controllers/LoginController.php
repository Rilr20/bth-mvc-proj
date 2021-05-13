<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() 
    {
        return view('login.login', ["title" => 'Inloggning']);
    }

    function checklogin(Request $request) 
    {
        // dd($request);
        $user_data = array(
            'username' => $request->get('username'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)) 
        {
            return redirect('blog/admin');
        }
        else {
            // return back()->with('wrong', 'Fel inloggning');
            return view('login.login', ['wrong' => 'Fel inloggning', 'title' => 'Inloggning']);
        }
    }
    function logout() {
        Auth::logout();
        return redirect('/', ['title' => 'laravel']);
    }
}