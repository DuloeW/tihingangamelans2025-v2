<?php

namespace App\Http\Controllers;

use App\Models\Gamelan;
use App\Models\UlasanBisnis;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index() {

        $gamelans = Gamelan::orderBy('gamelan_id')->paginate(6);
        $ulasan = UlasanBisnis::where('rating', '>=', 4)
                    ->with('pengguna')
                    ->orderBy('created_at', 'desc')->take(5)->get();

        return view ('home', compact('gamelans', 'ulasan'));
    }


}
