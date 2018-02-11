<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use App\Category;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }
    
    public function create(){
        $categorias = Category::Orderby('name')->get();
        return view('admin.posts.create', compact('categorias'));
    }
}
