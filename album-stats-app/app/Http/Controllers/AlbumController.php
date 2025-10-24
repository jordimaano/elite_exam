<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('artist')->orderBy('id')->paginate(10);
        return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $artists = Artist::orderBy('name')->get();
        return view('albums.create', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'name' => 'required|string|max:255',
            'sales' => 'nullable|numeric',
            'details' => 'nullable|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = '';
        if ($request->album_cover) {
            $photo = time() . '.' . $request->album_cover->extension();
            $request->album_cover->move(public_path('images'), $photo);
        }

        $validated['album_cover'] = $photo;

        Album::create($validated);

        return redirect()->route('albums.index')->with('success', 'Album added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        $album->load('artist');
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        $artists = Artist::orderBy('name')->get();
        return view('albums.edit', compact('album', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {

        $validated = $request->validate([
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'name' => 'required|string|max:255',
            'sales' => 'nullable|numeric',
            'details' => 'nullable|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photo = $album->album_cover; // Keep old photo if not replaced

        if ($request->album_cover) {
            // Delete old image if exists
            if ($album->album_cover && File::exists(public_path('images/' . $album->album_cover))) {
                File::delete(public_path('images/' . $album->album_cover));
            }

            $photo = time() . '.' . $request->album_cover->extension();
            $request->album_cover->move(public_path('images'), $photo);
        }

        $validated['album_cover'] = $photo;

        $album->update($validated);

        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        if ($album->album_cover && File::exists(public_path('images/' . $album->album_cover))) {
            File::delete(public_path('images/' . $album->album_cover));
        }

        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }
}
