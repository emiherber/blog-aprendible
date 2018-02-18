<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title','body','excerpt','category_id','published_at','iframe'
    ];

    /*
     * Definimos como una instancia de carbon
     */
    protected $dates = ['published_at'];

    /*
     * Redifinimos por cual parametros queremos que nos 
     * devuelva un post
     */
    public function getRoutekeyName(){
        return 'url';
    }
    
    public function category(){
        // un post pertenece a una categoria
        return $this->belongsTo(Category::class);
    }
    
    public function tags(){
        // un post pertenece a muchos tags
        return $this->belongsToMany(Tag::class);
    }
    
    public function photos(){
        // un post tiene muchas fotos
        return $this->HasMany(Photo::class);
    }

    public function scopePublished($query){
        $query->whereNotnull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');
    }

    /** 
     * Mutador setAtributoattribute(valor)
    */
    public function setTitleAttribute($title){
        $this->attributes['title'] = $title;
        $this->attributes['url'] = str_slug($title);
    }

    public function setPublishedAtAttribute($published_at){
        $this->attributes['published_at'] = null;
 
        if(!is_null($published_at)){
            $this->attributes['published_at'] = Carbon::parse($published_at);
        }       
    }

    public function setCategoryIdAttribute($category){
        if (Category::find($category)) {
            $this->attributes['category_id'] = $category;
        }else{
            $this->attributes['category_id'] = Category::create(['name' => $category])->id;
        }
              
    }

    public function syncTags($tags){
        $tagIds = Collect($tags)->map(function($tag){
            return Tag::find($tag)? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }
}