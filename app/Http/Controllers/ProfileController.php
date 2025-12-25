<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Laravolt\Indonesia\Models\Provinsi;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $province = Provinsi::where('code', $user->province_code)->first();
        $cities = City::where('code', $user->city_code)->first();
        $districts = District::where('code', $user->district_code)->first();
        
        return view('profile.edit', [
            'user' => $request->user(),
            'province_name' => $province ? $province->name : null,
            'city_name'     => $cities ? $cities->name : null,
            'district_name' => $districts ? $districts->name : null,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function show(Request $request): View
    {
        $user = Auth::user();
        $province = Provinsi::where('code', $user->province_code)->first();
        $cities = City::where('code', $user->city_code)->first();
        $districts = District::where('code', $user->district_code)->first();

        return view('profile.show', [
            'user' => $request->user(),
            'province_name' => $province ? $province->name : null,
            'city_name'     => $cities ? $cities->name : null,
            'district_name' => $districts ? $districts->name : null,
        ]);
    }
}
