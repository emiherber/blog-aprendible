<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $guarded = [];
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
    
    public function scopePublished($query){
        $query->whereNotnull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');
    }
}
