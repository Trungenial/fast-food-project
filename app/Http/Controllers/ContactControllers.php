<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactControllers extends Controller
{
    function home() {
        return view("pages.contact");
    }
}
