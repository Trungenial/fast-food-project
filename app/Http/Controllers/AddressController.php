<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function getDistricts($province_code)
    {
        $districts = DB::table('districts')
            ->where('province_code', $province_code)
            ->select('code', 'name') // chỉ cần code & name
            ->get();

        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = DB::table('wards')
            ->where('district_code', $district_code)
            ->select('code', 'name')
            ->get();

        return response()->json($wards);
    }
}
