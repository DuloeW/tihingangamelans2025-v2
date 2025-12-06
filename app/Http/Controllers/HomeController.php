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
        $ulasan = UlasanBisnis::orderBy('ulasan_bisnis_id')->paginate(5);

        return view ('home', compact('gamelans', 'ulasan'));
    }


}
