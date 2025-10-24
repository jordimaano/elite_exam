<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topArtist = Artist::withSum('albums', 'sales')
            ->orderByDesc('albums_sum_sales')
            ->first();
        // dd($topArtist);
        $monstaX = Artist::with('albums')
            ->where('name', 'Monsta X')
            ->first();
        // dd($monstaX);
        $artists = Artist::withSum('albums', 'sales')
            ->orderByDesc('albums_sum_sales')
            ->get();
        // dd($artists);
        $artistTotalAlbum = Artist::withCount('albums')
            ->withSum('albums', 'sales')
            ->orderByDesc('albums_sum_sales')
            ->get();
        // dd($artistTotalAlbum);
        return view('home', compact('topArtist', 'monstaX', 'artists', 'artistTotalAlbum'));
    }
}
