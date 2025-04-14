<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        if ($request->has('birthdate')) {
            try {
                $convertedDate = Carbon::createFromFormat('d/m/Y', $request->birthdate)->format('Y-m-d');
                $request->merge(['birthdate' => $convertedDate]);
            } catch (\Exception $e) {
                Log::error('Lỗi chuyển đổi ngày sinh: ' . $e->getMessage(), [
                    'input_birthdate' => $request->birthdate,
                    'exception' => $e
                ]);

                return back()->withErrors(['birthdate' => 'Ngày sinh không hợp lệ.'])->withInput();
            }
        }

        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'phone' => 'nullable|string|max:20',
                'birthdate' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'province' => 'nullable|string|max:255',
                'agree_policy' => 'required|boolean',
                'receive_discount' => 'nullable|boolean',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'province' => $request->province,
                'agree_policy' => $request->agree_policy,
                'receive_discount' => $request->receive_discount ?? false,
            ]);

            event(new Registered($user));
            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        } catch (\Exception $e) {
            Log::error('Lỗi khi tạo người dùng: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e
            ]);

            return back()->withErrors(['error' => 'Đã xảy ra lỗi khi đăng ký. Vui lòng thử lại.'])->withInput();
        }
    }
}
