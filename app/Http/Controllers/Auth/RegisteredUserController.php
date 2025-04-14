<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'province_code' => ['required', 'string'],
            'district_code' => ['required', 'string'],
            'ward_code' => ['required', 'string'],
            'gender' => ['required', 'in:Nam,Nữ,Khác'],
            'birthday' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Lấy tên từ mã
        $province = DB::table('provinces')->where('code', $request->province_code)->value('name');
        $district = DB::table('districts')->where('code', $request->district_code)->value('name');
        $ward     = DB::table('wards')->where('code', $request->ward_code)->value('name');

        // Chèn vào DB
        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
            'password' => Hash::make($request->password),
            'role' => 'customer',
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user = DB::table('users')->where('id', $userId)->first();

        event(new Registered((object)$user)); 
        Auth::loginUsingId($userId);

        return redirect(RouteServiceProvider::HOME);
    }
}
