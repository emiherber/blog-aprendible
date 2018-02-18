<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{ 

    public function getRoutekeyName(){
        return 'url';
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    /** 
     * Mutador setAtributoattribute(valor)
    */
    public function setNameAttribute($name){
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
