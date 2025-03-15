<?php

namespace App\Http\Controllers;
use App\Models\Store;

use Illuminate\Http\Request;

class StoreControllers extends Controller
{
    public function store()
    {
        $stores = Store::all();
        return view('pages.store', compact('stores'));
    }
}
