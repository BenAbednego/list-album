<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $albums = $user->albums()->orderBy('created_at', 'desc')->get();
        
        $activeAlbumId = $request->query('album_id');
        $activeAlbum = null;

        if ($activeAlbumId) {
            $activeAlbum = $user->albums()->find($activeAlbumId);
        }

        if (!$activeAlbum && $albums->count() > 0) {
            $activeAlbum = $albums->first();
        }

        $photos = collect();
        if ($activeAlbum) {
            $search = $request->query('search');
            $query = $activeAlbum->photos()->orderBy('created_at', 'desc');
            
            if (!empty($search)) {
                $query->where('title', 'like', '%' . $search . '%');
            }
            
            $photos = $query->get();
        }

        // If it's an AJAX request (e.g. for search), return only the grid partial
        if ($request->ajax()) {
            return response()->json([
                'html' => view('dashboard.partials.photos-grid', compact('activeAlbum', 'photos'))->render()
            ]);
        }

        return view('dashboard.index', compact('albums', 'activeAlbum', 'photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album = Auth::user()->albums()->create([
            'name' => $request->name,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'album' => $album,
                'redirect_url' => route('dashboard', ['album_id' => $album->id])
            ]);
        }

        return redirect()->route('dashboard', ['album_id' => $album->id]);
    }

    public function update(Request $request, Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $album->update([
            'name' => $request->name,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'album' => $album
            ]);
        }

        return redirect()->route('dashboard', ['album_id' => $album->id]);
    }

    public function destroy(Album $album)
    {
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $album->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'redirect_url' => route('dashboard')
            ]);
        }

        return redirect()->route('dashboard');
    }
}
