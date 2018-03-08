<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller {

    public function index() {
        $posts = Post::Allowed()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function store(Request $request) {
        $this->authorize('create', new Post);

        $this->validate($request,['title' => 'required']);

        return redirect()->route('admin.posts.edit', [
            'post' => Post::create($request->all())
        ]);
    }

    public function edit(Post $post){
        $this->authorize('view', $post);        

        return view('admin.posts.edit', [
            'post' => $post, 
            'tags' => Tag::Orderby('name')->get(), 
            'categorias' => Category::Orderby('name')->get()
        ]);
    }

    public function update(StorePostRequest $request, Post $post) {
        $this->authorize('update', $post);
        $post->update($request->all());
        $post->synctags($request->get('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('exito','Tu publicación ha sido guardada.');
    }
    
    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('exito', 'Tu publicación ha sido eliminada.');
    }
}
