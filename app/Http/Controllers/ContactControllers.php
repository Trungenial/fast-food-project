<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class ContactControllers extends Controller
{
    function contact() {
        return view("pages.contact");
    }

    function message(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => now(), 
        ];
        DB::table('customer_messages')->insert($data);

        return redirect('/contact')->with('success', 'Tin nhắn đã được gửi thành công!');
    }
    
}
