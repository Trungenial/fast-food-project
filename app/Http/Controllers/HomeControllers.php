<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeControllers extends Controller
{
    function home() {
        return view("pages.home");
    }

    function policy() {
        return view("pages.policy");
    }
}
