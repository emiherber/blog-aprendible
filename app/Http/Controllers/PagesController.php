<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller
{
    public function home(){
        $posts = Post::published()->get();
        return view('welcome', compact('posts'));
    }
}
