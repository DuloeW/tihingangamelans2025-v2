<?php

namespace App\Http\Controllers;

use App\Models\Gamelan;
use Illuminate\Http\Request;

class GalleryGamelanController extends Controller
{
    public function index() {
        $gamelans = $this->fetchGamelanData();
        return view('gallery-gamelan', compact('gamelans'));
    }

    private function fetchGamelanData() {
        return Gamelan::orderBy('gamelan_id')->get();
    }

    public function show($slug) {
        $gamelan = Gamelan::where('slug', $slug)->firstOrFail();
        
        // Ambil gamelan lainnya (exclude yang sedang ditampilkan), maksimal 6
        $otherGamelans = Gamelan::where('gamelan_id', '!=', $gamelan->gamelan_id)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        
        return view('gallery-gamelan-detail', compact('gamelan', 'otherGamelans'));
    }
}
