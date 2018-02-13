<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller {

    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create() {
        $tags = Tag::Orderby('name')->get();
        $categorias = Category::Orderby('name')->get();
        return view('admin.posts.create', compact('categorias', 'tags'));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ]);
        $post = new Post;
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->category_id = $request->get('category');
        $post->published_at = (!is_null($request->get('published_at'))) ? Carbon::parse($request->get('published_at')) : null;
        $post->url = str_slug($post->title);
        $post->save();
        $post->tags()->attach($request->get('tags'));
        return back()->with('exito','Tu publicación ha sido creada.');
    }

}
