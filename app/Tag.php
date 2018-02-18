<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];
    
    public function getRoutekeyName(){
        return 'url';
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }

    /** 
     * Mutador setAtributoattribute(valor)
    */
    public function setNameAttribute($name){
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
