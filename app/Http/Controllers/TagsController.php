<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag){
        $title = 'Publicaciones de la Etiqueta '.$tag->name;
        $posts = $tag->posts()->published()->paginate();
        return view('pages.home', compact('posts', 'title'));
    }
}
