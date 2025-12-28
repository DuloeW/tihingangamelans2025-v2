<?php

namespace App\Http\Controllers;

use App\Models\Bisnis;
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
        
        $stores = Bisnis::where(function($query) {
                    $query->where('status', 'active')
                          ->orWhere('status', 'verified');
                })
                ->with(['ulasanBisnis', 'katalogs.ulasan'])
                ->get()
                ->filter(function($bisnis) {
                    return $bisnis->average_rating >= 3;
                })
                ->take(6);

        return view ('home', compact('gamelans', 'ulasan', 'stores'));
    }


}
