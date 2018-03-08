<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title','body','excerpt','category_id','published_at','iframe','user_id'
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
    
    protected static function boot(){
        parent::boot();
        static::deleting(function($post){
            $post->tags()->detach();
            // comvierto en una colección y por cada photo llama al metodo delete.
            $post->photos->each->delete();
        });
    }

    public static function create(array $attributes = []){
        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        return $post;
    }
    
    /**
     * inicio Relaciones
     */
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

    public function syncTags($tags){
        $tagIds = Collect($tags)->map(function($tag){
            return Tag::find($tag)? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }
    
    public function isPublished(){
        return !is_null($this->published_at) && $this->published_at < today();
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Fin relaciones
     */

    /** 
     * Mutador setAtributoattribute(valor)
    */
    public function setTitleAttribute($title){
        $this->attributes['title'] = $title;
        $url = str_slug($title) . '-' . uniqid();
        $this->attributes['url'] = $url;
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
    /**
     * Fin Mutadores
     */

    /**
     * Inicio scope
     */
    public function scopePublished($query){
        $query->whereNotnull('published_at')
                ->where('published_at', '<=', Carbon::now())
                ->latest('published_at');
    }

    public function scopeAllowed($query){
        if(auth()->user()->can('view', $this)){
            return $query;
        }
        return $query->where('user_id', auth()->id());
    }
    /**
     * Fin scope
     */

    /**
     * Inicio funciones auxiliares
     */
    public function viewType($ubicacion = ''){
        if ($this->photos->count() === 1){
            return 'posts.photo';
        }elseif($this->photos->count() > 1){
            return $ubicacion === 'home' ? 'posts.carousel-preview': 'posts.carousel';
        }elseif($this->iframe){
            return 'posts.iframe';
        }
        return 'posts.text';
    }
    /**
     * Fin funciones auxiliares
     */  
}