<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();
        
        $category = new Category;
        $category->name = 'Categoria 1';
        $category->save();
        
        $category = new Category;
        $category->name = 'Categoria 2';
        $category->save();
        
        $post = new Post;
        $post->title = 'Mi primer post';
        $post->excerpt = 'Extracto de mi primer post';
        $post->body = 'Cuerpo de mi primer post';
        $post->published_at = \Carbon\Carbon::now();
        $post->category_id = 1;
        $post->save();
        
        $post = new Post;
        $post->title = 'Mi segundo post';
        $post->excerpt = 'Extracto de mi segundo post';
        $post->body = 'Cuerpo de mi segundo post';
        $post->published_at = \Carbon\Carbon::now()->subDay(2);
        $post->category_id = 2;
        $post->save();
        
        $post = new Post;
        $post->title = 'Mi tercer post';
        $post->excerpt = 'Extracto de mi tercer post';
        $post->body = 'Cuerpo de mi tercer post';
        $post->published_at = \Carbon\Carbon::now()->subDay(1);
        $post->category_id = 1;
        $post->save();
    }
}
