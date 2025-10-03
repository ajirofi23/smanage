<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    function index()
    {
        return view('panel.manage.index');
    }
    function manager() {
        echo "Welcome to the panel manager!";
        echo "<h1>". Auth::user()->name ."</h1>";
        echo "<a href='/logout'>Logout</a>";
    }
    function supervisor() {
        echo "Welcome to the panel spv!";
        echo "<h1>". Auth::user()->name ."</h1>";
        echo "<a href='/logout'>Logout</a>";
    }
    function employee() {
        echo "Welcome to the panel employee!";
        echo "<h1>". Auth::user()->name ."</h1>";
        echo "<a href='/logout'>Logout</a>";
    }
    public function hyariHatto()
{
    return view('panel.manage.hyari-hatto');
}

}
