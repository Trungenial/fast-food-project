<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartControllers extends Controller
{
    public function vieworder(){
        return view('pages.order');
    }

    public function cartadd(Request $request)
    {
        $request->validate([
            "id"=>["required","numeric"],
            "num"=>["required","numeric"]
        ]);
        $id = $request->id;
        $num = $request->num;
        $total = 0;
        $cart = [];
        if(session()->has('cart'))
        {
            $cart = session()->get("cart");
            if(isset($cart[$id]))
                $cart[$id] += $num;
            else
                $cart[$id] = $num ;
        }
        else
        {
            $cart[$id] = $num ;
        }
        session()->put("cart",$cart);
        return count($cart);
    }

    public function order()
    {
        $cart=[];
        $data =[];
        $quantity = [];
        if(session()->has('cart'))
        {
            $cart = session("cart");
            $order = "";
            foreach($cart as $id=>$value)
            {
                $quantity[$id] = $value;
                $order .=$id.", ";
            }
            $order = substr($order, 0,strlen($order)-2);
            $data = DB::table("products")->whereRaw("id in (".$order.")")->first();
        }
        return view("pages.order",compact("quantity","data"));
    }
}