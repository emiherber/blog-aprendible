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

        $post->photos()->create([
            'url' => request()->file('photo')->store('posts')
        ]);
    }

    public function destroy(Photo $photo){
        $photo->delete();
        return back()->with('exito', 'Imagen eliminada.');
    }
}
