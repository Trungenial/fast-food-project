<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function accountpanel()
    {
        $user = Auth::user();

        // Lấy code tương ứng từ bảng provinces/districts/wards theo tên đã lưu
        $provinceCode = DB::table('provinces')->where('name', $user->province)->value('code');
        $districtCode = DB::table('districts')->where('name', $user->district)->value('code');

        $provinces = DB::table('provinces')->get();

        $districts = $provinceCode
            ? DB::table('districts')->where('province_code', $provinceCode)->get()
            : [];

        $wards = $districtCode
            ? DB::table('wards')->where('district_code', $districtCode)->get()
            : [];

        return view('pages.account', compact('user', 'provinces', 'districts', 'wards', 'provinceCode', 'districtCode'));
    }

    public function saveaccountinfo(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'ward' => ['required'],
            'gender' => ['nullable', 'in:Nam,Nữ,Khác'],
            'birthday' => ['nullable', 'date'],
        ]);


        $provinceName = DB::table('provinces')->where('code', $request->province)->value('name');
        $districtName = DB::table('districts')->where('code', $request->district)->value('name');
        $wardName = DB::table('wards')->where('code', $request->ward)->value('name');

        DB::table('users')->where('id', Auth::id())->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $provinceName,
            'district' => $districtName,
            'ward' => $wardName,
            'gender' => $request->gender,
            'birthday' => $request->birthday,

        ]);

        return redirect()->route('account')->with('status', 'Cập nhật thành công!');
    }
}
