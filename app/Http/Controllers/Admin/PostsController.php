<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller {

    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    // public function create() {
    //     $tags = Tag::Orderby('name')->get();
    //     $categorias = Category::Orderby('name')->get();
    //     return view('admin.posts.create', compact('categorias', 'tags'));
    // }

    public function store(Request $request) {
        $this->validate($request,[
            'title' => 'required'
        ]);

        $post = Post::create($request->only('title'));

        return redirect()->route('admin.posts.edit', $post);
    }

    public function edit(Post $post){
        $tags = Tag::Orderby('name')->get();
        $categorias = Category::Orderby('name')->get();

        return view('admin.posts.edit', compact('categorias', 'tags', 'post'));
    }

    public function update(StorePostRequest $request, Post $post) {
        $post->update($request->all());
        return redirect()->route('admin.posts.edit', $post)->with('exito','Tu publicación ha sido guardada.');
    }

}
