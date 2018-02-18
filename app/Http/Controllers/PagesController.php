<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller
{
    public function home(){
        $posts = Post::published()->paginate();
        return view('welcome', compact('posts'));
    }
}
