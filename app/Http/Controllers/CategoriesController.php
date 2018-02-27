<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function show(Category $category){
        $title = 'Publicaciones de la Categoría '.$category->name;
        $posts = $category->posts()->paginate();
        return view('pages.home', compact('posts','title'));
    }
}
