<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function create(Request $request)
    {
        $albumId = $request->query('album_id');
        $user = Auth::user();
        
        $albums = $user->albums()->orderBy('created_at', 'desc')->get();
        $activeAlbum = $albumId ? $user->albums()->find($albumId) : $albums->first();

        if (!$activeAlbum) {
            return redirect()->route('dashboard')->with('error', 'Buat album terlebih dahulu sebelum menambah foto.');
        }

        return view('photos.create', compact('albums', 'activeAlbum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $album = Auth::user()->albums()->findOrFail($request->album_id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            $imagePath = 'uploads/' . $filename;
        } else {
            return back()->withErrors(['photo' => 'File foto wajib diunggah.']);
        }

        $album->photos()->create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard', ['album_id' => $album->id]);
    }

    public function show(Photo $photo)
    {
        $album = $photo->album;
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();
        $albums = $user->albums()->orderBy('created_at', 'desc')->get();

        return view('photos.show', compact('photo', 'album', 'albums'));
    }

    public function edit(Photo $photo)
    {
        $album = $photo->album;
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $user = Auth::user();
        $albums = $user->albums()->orderBy('created_at', 'desc')->get();
        $activeAlbum = $album;

        return view('photos.edit', compact('photo', 'album', 'albums', 'activeAlbum'));
    }

    public function update(Request $request, Photo $photo)
    {
        $album = $photo->album;
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $imagePath = $photo->image_path;

        if ($request->hasFile('photo')) {
            $oldFile = public_path($photo->image_path);
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $filename);
            $imagePath = 'uploads/' . $filename;
        }

        $photo->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard', ['album_id' => $album->id]);
    }

    public function destroy(Photo $photo)
    {
        $album = $photo->album;
        if ($album->user_id !== Auth::id()) {
            abort(403);
        }

        $file = public_path($photo->image_path);
        if (File::exists($file)) {
            File::delete($file);
        }

        $photo->delete();

        return redirect()->route('dashboard', ['album_id' => $album->id]);
    }
}
