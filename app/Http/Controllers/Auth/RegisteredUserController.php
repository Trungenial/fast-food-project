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
        'customer-lastname' => ['required', 'string', 'max:255'],
        'customer-firstname' => ['required', 'string', 'max:255'],
        'customer-phone-number' => ['required', 'regex:/^[0-9]{9,15}$/'],
        'customer-email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'customer-password' => ['required', 'confirmed', Rules\Password::defaults()],
        'birthdate' => ['required', 'date_format:d/m/Y'],
        'customer-gender' => ['required', 'in:1,2,3'],
        'province' => ['required', 'string'],
        'agree-checkbox' => ['accepted'],
    ]);
    dd($request);
    // Gộp họ và tên
    $fullName = $request->input('customer-lastname') . ' ' . $request->input('customer-firstname');

    $user = User::create([
        'name' => $fullName,
        'email' => $request->input('customer-email'),
        'password' => Hash::make($request->input('customer-password')),
        'phone' => $request->input('customer-phone-number'),
        'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->input('birthdate'))->format('Y-m-d'),
        'gender' => $request->input('customer-gender'),
        'province' => $request->input('province'),
        'agree_policy' => true,
        'receive_discount' => $request->has('discount-checkbox'),
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect()->route('dashboard');
}
}
// public function store(Request $request): RedirectResponse
//     {
//         $request->validate([
//             'name' => ['required', 'string', 'max:255'],
//             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
//             'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//         ]);

//         event(new Registered($user));

//         Auth::login($user);

//         return redirect(route('dashboard', absolute: false));
//     }
