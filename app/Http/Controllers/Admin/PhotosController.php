<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Photo;

class PhotosController extends Controller
{
    public function store(Post $post){
        $this->validate(request(), [
            'photo' => 'image|max:2048'
        ]);
        $photo = request()->file('photo')->store('public');
        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id
        ]);
    }

    public function destroy(Photo $photo){
        $photo->delete();
        $photoPath = str_replace('storage', 'public', $photo->url);
        
        Storage::delete($photoPath);

        return back()->with('exito', 'Imagen eliminada.');
    }
}
