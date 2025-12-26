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
            'city_code' => ['required', 'string', 'max:45'],
            'district_code' => ['required', 'string', 'max:45'],
            'province_code' => ['required', 'string', 'max:45'],
            'no_telephone' => ['required', 'string', 'max:20'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:100', 'unique:'.Pengguna::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $hp = $request->no_telephone;
        $hp = preg_replace('/[^0-9]/', '', $hp); // Hapus selain angka

        if (str_starts_with($hp, '0')) {
        $hp = '+62' . substr($hp, 1);
         } elseif (str_starts_with($hp, '62')) {
        $hp = '+' . $hp;
        } elseif (!str_starts_with($hp, '0') && !str_starts_with($hp, '62')) {
        $hp = '+62' . $hp;
        }

        try {

            $path_gambar = 'default.png';

            if($request->hasFile('gambar')) {
                $path_gambar = $request->file('gambar')->store('foto-profile-pengguna', 'public');
            }

            $user = Pengguna::create([
                'nama' => $request->nama,
                'user_name' => $request->user_name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'city_code' => $request->city_code,
                'district_code' => $request->district_code,
                'province_code' => $request->province_code,
                'no_telephone' => $hp,
                'email' => $request->email,
                'gambar' => $path_gambar,
                'password' => Hash::make($request->password),
            ]);
        } catch (\Exception $th) {
            dd($th->getMessage());
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
