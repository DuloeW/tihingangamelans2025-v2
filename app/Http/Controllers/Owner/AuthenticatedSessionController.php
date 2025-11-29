<?php

// app/Http/Controllers/Owner/AuthenticatedSessionController.php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Bisa pakai request bawaan Breeze atau buat baru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    // Tampilkan form login Owner
    public function create(): View
    {
        return view('owner.auth.login'); // Kita buat view ini nanti
    }

    // Proses Login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login menggunakan guard 'owner'
        if (Auth::guard('owner')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('owner.dashboard')); // Redirect ke dashboard owner
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // Logout
    public function destroy(Request $request)
    {
        Auth::guard('owner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/owner/login');
    }
}
