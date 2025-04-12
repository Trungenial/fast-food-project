<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartControllers extends Controller
{
    public function order() {
        return view ('pages.order');
    }
}
