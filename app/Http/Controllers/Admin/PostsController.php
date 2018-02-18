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

    public function update(Request $request, Post $post) {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ]);
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $cat = $request->get('category');
        $post->category_id = Category::find($cat)? $cat : Category::create(['name' => $cat])->id;
        $post->published_at = (!is_null($request->get('published_at'))) ? Carbon::parse($request->get('published_at')) : null;
        $post->iframe = $request->get('iframe');
        $post->save();
        $tags = [];
        foreach ($request->get('tags') as $tag) {
            $tags[] = Tag::find($tag)? $tag : Tag::create(['name' => $tag])->id;
        }
        $post->tags()->sync($tags);
        return redirect()->route('admin.posts.edit', $post)->with('exito','Tu publicación ha sido guardada.');
    }

}
