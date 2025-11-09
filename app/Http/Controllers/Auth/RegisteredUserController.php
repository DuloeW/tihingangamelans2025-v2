<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
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
            'nama' => ['required', 'string', 'max:150'],
            'user_name' => ['required', 'string', 'max:45'],
            'jenis_kelamin' => ['required', 'string', 'max:45'],
            'kabupaten' => ['required', 'string', 'max:45'],
            'kecamatan' => ['required', 'string', 'max:45'],
            'provinsi' => ['required', 'string', 'max:45'],
            'no_telephone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.Pengguna::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Pengguna::create([
            'nama' => $request->nama,
            'user_name' => $request->user_name,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'provinsi' => $request->provinsi,
            'no_telephone' => $request->no_telephone,
            'email' => $request->email,
            'gambar' => 'default.png',
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
