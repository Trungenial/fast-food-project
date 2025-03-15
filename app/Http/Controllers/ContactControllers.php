<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactControllers extends Controller
{
    function contact() {
        return view("pages.contact");
    }
}
