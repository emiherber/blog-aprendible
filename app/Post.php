<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /*
     * Definimos como una instancia de carbon
     */
    protected $dates = ['published_at'];
    
    public function category(){
        // un post pertenece a una categoria
        return $this->belongsTo(Category::class);
    }
    
    public function tags(){
        // un post pertenece a muchos tags
        return $this->belongsToMany(Tag::class);
    }
}
