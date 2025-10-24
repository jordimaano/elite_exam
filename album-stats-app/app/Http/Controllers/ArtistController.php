<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Console\Events\ArtisanStarting;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::orderBy('id')->paginate(10);
        return view('artists.artists_index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.artists_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name',
        ]);

        Artist::create($validated);

        return redirect()->route('artists.index')
            ->with('success', 'Artist added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artists.artists_show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.artists_edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:artists,name,' . $artist->id,
            'code' => 'nullable|string|max:100',
        ]);

        $artist->update($validated);

        return redirect()->route('artists.index')
            ->with('success', 'Artist updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')
            ->with('success', 'Artist deleted successfully!');
    }
}
